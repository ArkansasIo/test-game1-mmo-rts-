<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/DefenseTechnologyService.php';
$pdo = db();
$playerId = 1;
$beforeResource = $pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=?');
$beforeResource->execute([$playerId]);
$beforeNaquadah = (int)$beforeResource->fetchColumn();
$maxQueue = (int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM construction_queue')->fetchColumn();
$maxEvent = (int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM game_events')->fetchColumn();
$queueCountBefore = (int)$pdo->query("SELECT COUNT(*) FROM construction_queue WHERE player_id=1 AND queue_type='research' AND status IN ('queued','processing')")->fetchColumn();
$result = null;
try {
    if ($queueCountBefore !== 0) throw new RuntimeException('Fortification queue test requires an available research queue.');
    $result = (new DefenseTechnologyService($pdo))->upgrade($playerId, 'fortification');
    $q = $pdo->prepare('SELECT id, item_key, level_before, completes_at, status FROM construction_queue WHERE id>? AND player_id=? ORDER BY id DESC LIMIT 1');
    $q->execute([$maxQueue, $playerId]);
    $queued = $q->fetch(PDO::FETCH_ASSOC);
    if (!$queued || $queued['item_key'] !== 'fortification') throw new RuntimeException('Fortification queue row was not persisted.');
    echo json_encode(['status'=>'passed','result'=>$result,'queued_row'=>$queued], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} finally {
    $pdo->prepare('DELETE FROM construction_queue WHERE id>? AND player_id=?')->execute([$maxQueue, $playerId]);
    $pdo->prepare('DELETE FROM game_events WHERE id>? AND player_id=?')->execute([$maxEvent, $playerId]);
    $pdo->prepare('UPDATE player_resources SET naquadah=? WHERE player_id=?')->execute([$beforeNaquadah, $playerId]);
}
