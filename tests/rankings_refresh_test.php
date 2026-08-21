<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/RankingsService.php';

$pdo = db();
$playerId = (int)($pdo->query('SELECT id FROM players ORDER BY id LIMIT 1')->fetchColumn() ?: 0);
if ($playerId < 1) throw new RuntimeException('No player available for rankings test.');
$pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key='ranking_refresh'")->execute([$playerId]);
$service = new RankingsService($pdo);
$result = $service->refresh($playerId);
if (($result['state'] ?? '') !== 'success' || count($result['rows'] ?? []) < 1) throw new RuntimeException('Ranking refresh did not return a successful ranked row set.');
$ranked = $pdo->prepare('SELECT overall_score,technology_score,glory_score,penalty_score,rank_position FROM rankings WHERE player_id=?');
$ranked->execute([$playerId]);
$row = $ranked->fetch(PDO::FETCH_ASSOC);
if (!$row || $row['rank_position'] === null) throw new RuntimeException('Ranking row was not persisted.');
$snapshot = $pdo->prepare('SELECT overall_score,technology_score,glory_score,penalty_score FROM rank_snapshots WHERE player_id=? AND snapshot_date=?');
$snapshot->execute([$playerId,$result['snapshot_date']]);
if (!$snapshot->fetch(PDO::FETCH_ASSOC)) throw new RuntimeException('Rank snapshot was not persisted.');
$read = $service->rankings($playerId, 200);
if (!in_array($read['state'], ['ready','empty'], true)) throw new RuntimeException('Ranking read returned invalid state.');
echo "rankings_refresh_test: PASS\n";
