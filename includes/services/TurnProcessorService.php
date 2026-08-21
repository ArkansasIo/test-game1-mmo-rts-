<?php
declare(strict_types=1);

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/GameService.php';

final class TurnProcessorService
{
    public function __construct(private PDO $pdo)
    {
    }

    public function run(?DateTimeImmutable $now = null, ?int $playerFilter = null, bool $dryRun = false): array
    {
        $now = $now ?? new DateTimeImmutable('now');
        $turnInterval = $this->setting('turn_interval_seconds', 1800);
        if ($turnInterval < 60) {
            throw new RuntimeException('Turn interval must be at least 60 seconds.');
        }

        $turnNumber = intdiv($now->getTimestamp(), $turnInterval);
        $run = $this->claimRun($turnNumber, $now, $dryRun);
        if ($run['skip'] === true) {
            return $run['summary'];
        }

        $started = microtime(true);
        $summary = [
            'job' => 'turn_processing',
            'turn_number' => $turnNumber,
            'interval_seconds' => $turnInterval,
            'started_at' => $now->format(DateTimeInterface::ATOM),
            'dry_run' => $dryRun,
            'player_filter' => $playerFilter,
            'players' => 0,
            'processed' => 0,
            'turns' => 0,
            'income' => 0,
            'errors' => [],
        ];

        try {
            $sql = 'SELECT id FROM players';
            $params = [];
            if ($playerFilter !== null) {
                $sql .= ' WHERE id = ?';
                $params[] = $playerFilter;
            }
            $sql .= ' ORDER BY id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $players = array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
            $summary['players'] = count($players);

            if ($dryRun) {
                $summary['message'] = 'Dry run only; no player state was mutated.';
            } else {
                $service = new GameService($this->pdo);
                foreach ($players as $playerId) {
                    try {
                        $result = $service->processTurns($playerId, $now);
                        $summary['processed']++;
                        $summary['turns'] += (int)($result['turns'] ?? 0);
                        $summary['income'] += (int)($result['income'] ?? 0);
                        $this->recordTurnEvent((int)$run['id'], $playerId, 'turn_processed', [
                            'turns' => (int)($result['turns'] ?? 0),
                            'income' => (int)($result['income'] ?? 0),
                            'due_intervals' => (int)($result['due_intervals'] ?? 0),
                        ]);
                    } catch (Throwable $e) {
                        $summary['errors'][] = [
                            'player_id' => $playerId,
                            'message' => $e->getMessage(),
                        ];
                        $this->recordTurnEvent((int)$run['id'], $playerId, 'turn_failed', [
                            'message' => $e->getMessage(),
                        ]);
                    }
                }
            }

            $summary['finished_at'] = (new DateTimeImmutable('now'))->format(DateTimeInterface::ATOM);
            $summary['duration_ms'] = round((microtime(true) - $started) * 1000, 2);
            $this->finishRun((int)$run['id'], $summary, $summary['errors'] === [] ? 'completed' : 'failed');
            return $summary;
        } catch (Throwable $e) {
            $summary['finished_at'] = (new DateTimeImmutable('now'))->format(DateTimeInterface::ATOM);
            $summary['duration_ms'] = round((microtime(true) - $started) * 1000, 2);
            $summary['fatal_error'] = $e->getMessage();
            $this->finishRun((int)$run['id'], $summary, 'failed');
            throw $e;
        }
    }

    private function claimRun(int $turnNumber, DateTimeImmutable $now, bool $dryRun): array
    {
        if ($dryRun) {
            return ['id' => 0, 'skip' => false, 'summary' => []];
        }

        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM game_turns WHERE turn_number = ? FOR UPDATE');
            $stmt->execute([$turnNumber]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($existing && $existing['status'] === 'completed') {
                $this->pdo->commit();
                $summary = json_decode((string)($existing['summary_json'] ?? '{}'), true);
                return ['id' => (int)$existing['id'], 'skip' => true, 'summary' => is_array($summary) ? $summary : []];
            }

            if ($existing) {
                $this->pdo->prepare('UPDATE game_turns SET processed_at=?,status=?,summary_json=? WHERE id=?')->execute([
                    $now->format('Y-m-d H:i:s'),
                    'started',
                    json_encode(['job' => 'turn_processing', 'turn_number' => $turnNumber, 'retry' => true], JSON_THROW_ON_ERROR),
                    (int)$existing['id'],
                ]);
                $id = (int)$existing['id'];
            } else {
                $insert = $this->pdo->prepare('INSERT INTO game_turns (turn_number,processed_at,status,summary_json) VALUES (?,?,?,?)');
                $insert->execute([$turnNumber, $now->format('Y-m-d H:i:s'), 'started', json_encode(['job' => 'turn_processing', 'turn_number' => $turnNumber], JSON_THROW_ON_ERROR)]);
                $id = (int)$this->pdo->lastInsertId();
            }
            $this->pdo->commit();
            return ['id' => $id, 'skip' => false, 'summary' => []];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    private function finishRun(int $runId, array $summary, string $status): void
    {
        if ($runId < 1) {
            return;
        }
        $stmt = $this->pdo->prepare('UPDATE game_turns SET processed_at=?,status=?,summary_json=? WHERE id=?');
        $stmt->execute([
            (new DateTimeImmutable('now'))->format('Y-m-d H:i:s'),
            $status,
            json_encode($summary, JSON_THROW_ON_ERROR),
            $runId,
        ]);
    }

    private function recordTurnEvent(int $runId, int $playerId, string $eventType, array $payload): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO turn_events (game_turn_id,player_id,event_type,amount_json) VALUES (?,?,?,?)');
        $stmt->execute([$runId, $playerId, $eventType, json_encode($payload, JSON_THROW_ON_ERROR)]);
    }

    private function setting(string $key, int $fallback): int
    {
        $stmt = $this->pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value === false ? $fallback : (int)$value;
    }
}
