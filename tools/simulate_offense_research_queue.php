<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/OffenseTechnologyService.php';
require_once __DIR__ . '/../includes/services/TechnologyTreeService.php';
$pdo = db();
$playerId = 1;
$resourceStmt = $pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=?');
$resourceStmt->execute([$playerId]);
$originalNaquadah = (int)$resourceStmt->fetchColumn();
$rowStmt = $pdo->prepare('SELECT * FROM player_technologies WHERE player_id=? AND technology_key=?');
$rowStmt->execute([$playerId, 'kinetic_lances']);
$originalTechnology = $rowStmt->fetch(PDO::FETCH_ASSOC) ?: null;
$maxResearchQueue = (int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM research_queues')->fetchColumn();
$maxEvent = (int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM game_events')->fetchColumn();
$results = [];
$expectFailure = static function (callable $fn, string $needle): array {
    try { $fn(); return ['passed'=>false,'message'=>'Expected failure did not occur.']; }
    catch (Throwable $e) { return ['passed'=>str_contains(strtolower($e->getMessage()), strtolower($needle)),'message'=>$e->getMessage()]; }
};
try {
    $service = new OffenseTechnologyService($pdo);
    $results['locked_prerequisite'] = $expectFailure(fn() => $service->upgrade($playerId, 'orbital_strike'), 'prerequisite');
    $pdo->prepare('UPDATE player_resources SET naquadah=0 WHERE player_id=?')->execute([$playerId]);
    $results['insufficient_resource'] = $expectFailure(fn() => $service->upgrade($playerId, 'kinetic_lances'), 'not enough naquadah');
    $pdo->prepare('UPDATE player_resources SET naquadah=? WHERE player_id=?')->execute([$originalNaquadah, $playerId]);
    $techId = (int)$pdo->query("SELECT id FROM technologies WHERE technology_key='kinetic_lances'")->fetchColumn();
    $now = new DateTimeImmutable('now');
    for ($i=0; $i<3; $i++) {
        $start = $now->modify('+'.$i.' minutes');
        $complete = $start->modify('+10 minutes');
        $pdo->prepare("INSERT INTO research_queues(player_id,technology_id,technology_key,level_before,level_after,base_effect,tier_coefficient,starts_at,completes_at,status) VALUES(?,?,?,?,?,?,?,?,?,?)")->execute([$playerId,$techId,'kinetic_lances',0,1,7,1.2,$start->format('Y-m-d H:i:s'),$complete->format('Y-m-d H:i:s'),'researching']);
    }
    $results['queue_capacity'] = $expectFailure(fn() => $service->upgrade($playerId, 'kinetic_lances'), 'queue capacity');
    $pdo->prepare('DELETE FROM research_queues WHERE id>? AND player_id=?')->execute([$maxResearchQueue, $playerId]);
    $pdo->prepare('UPDATE player_resources SET naquadah=? WHERE player_id=?')->execute([$originalNaquadah, $playerId]);
    $valid = $service->upgrade($playerId, 'kinetic_lances');
    $q = $pdo->prepare('SELECT id,technology_key,level_before,level_after,status FROM research_queues WHERE id>? AND player_id=? ORDER BY id DESC LIMIT 1');
    $q->execute([$maxResearchQueue, $playerId]);
    $queued = $q->fetch(PDO::FETCH_ASSOC);
    $results['valid_queue'] = ['passed'=>(bool)$queued && $queued['technology_key']==='kinetic_lances' && (int)$queued['level_after']===(int)$queued['level_before']+1,'message'=>'Queued Kinetic Lance Array level '.$valid['level_after'].'.'];
} finally {
    $pdo->prepare('DELETE FROM research_queues WHERE id>? AND player_id=?')->execute([$maxResearchQueue, $playerId]);
    $pdo->prepare('DELETE FROM game_events WHERE id>? AND player_id=?')->execute([$maxEvent, $playerId]);
    $pdo->prepare('UPDATE player_resources SET naquadah=? WHERE player_id=?')->execute([$originalNaquadah, $playerId]);
    if ($originalTechnology === null) {
        $pdo->prepare('DELETE FROM player_technologies WHERE player_id=? AND technology_key=?')->execute([$playerId, 'kinetic_lances']);
    } else {
        $columns = array_keys($originalTechnology);
        $assignments = implode(',', array_map(static fn(string $c): string => "`$c`=?", $columns));
        $values = array_values($originalTechnology);
        $values[] = $playerId;
        $values[] = 'kinetic_lances';
        $pdo->prepare("UPDATE player_technologies SET ".implode(',', array_map(static fn(string $c): string => "`$c`=?", array_slice($columns, 1)))." WHERE player_id=? AND technology_key=?")->execute(array_merge(array_values(array_slice($originalTechnology, 1)), [$playerId, 'kinetic_lances']));
    }
}
$failures = array_keys(array_filter($results, static fn(array $r): bool => !($r['passed'] ?? false)));
echo json_encode(['status'=>$failures?'failed':'passed','results'=>$results,'failures'=>$failures], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
exit($failures ? 1 : 0);
