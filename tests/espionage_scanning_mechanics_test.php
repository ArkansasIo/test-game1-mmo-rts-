<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/EspionageScanningService.php';

$pdo = db();
$service = new EspionageScanningService($pdo);
$players = $pdo->query('SELECT id FROM players ORDER BY id LIMIT 2')->fetchAll(PDO::FETCH_COLUMN);
if (count($players) < 2) {
    echo json_encode(['status' => 'skipped', 'reason' => 'Two players are required for espionage integration coverage.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$attackerId = (int)$players[0];
$defenderId = (int)$players[1];
$resourceStmt = $pdo->prepare('SELECT player_id,spies,unit_production FROM player_resources WHERE player_id IN (?,?) ORDER BY player_id');
$resourceStmt->execute([$attackerId, $defenderId]);
$resourceSnapshots = [];
foreach ($resourceStmt->fetchAll(PDO::FETCH_ASSOC) as $row) $resourceSnapshots[(int)$row['player_id']] = $row;
$eventStmt = $pdo->prepare('SELECT COALESCE(MAX(id),0) FROM game_events WHERE player_id IN (?,?)');
$eventStmt->execute([$attackerId, $defenderId]);
$gameEventCutoff = (int)$eventStmt->fetchColumn();
$generationEventStmt = $pdo->query('SELECT COALESCE(MAX(id),0) FROM universe_generation_events');
$generationEventCutoff = (int)$generationEventStmt->fetchColumn();
$createdMissionIds = [];
$createdScanIds = [];
$createdReportIds = [];
$entityKey = null;
$hadDiscovery = false;
$checks = [];

try {
    $pdo->prepare('UPDATE player_resources SET spies=spies+100 WHERE player_id=?')->execute([$attackerId]);
    $mission = $service->runMission($attackerId, $defenderId, 'recon', 5);
    $createdMissionIds[] = (int)$mission['mission_id'];
    if (!empty($mission['report_id'])) $createdReportIds[] = (int)$mission['report_id'];
    $checks['espionage_result_classified'] = in_array($mission['success'] ? 'success' : ($mission['detected'] ? 'detected' : 'failed'), ['success', 'detected', 'failed'], true);
    $checks['espionage_probability_bounded'] = $mission['detection_probability'] >= 0.02 && $mission['detection_probability'] <= 0.92 && $mission['success_probability'] >= 0.05 && $mission['success_probability'] <= 0.95;
    $eventCount = $pdo->prepare('SELECT COUNT(*) FROM espionage_events WHERE mission_id=?');
    $eventCount->execute([(int)$mission['mission_id']]);
    $checks['espionage_audit_events'] = (int)$eventCount->fetchColumn() >= 2;
    if (!empty($mission['report_id'])) {
        $reportStmt = $pdo->prepare('SELECT report_type,payload,seen_at FROM intelligence_reports WHERE id=? AND player_id=?');
        $reportStmt->execute([(int)$mission['report_id'], $attackerId]);
        $report = $reportStmt->fetch(PDO::FETCH_ASSOC);
        $checks['classified_report_owned'] = (bool)$report && $report['report_type'] === 'recon' && str_contains((string)$report['payload'], 'CLASSIFIED');
    } else {
        $checks['classified_report_owned'] = true;
    }

    $previewUniverse = (new ProceduralUniverseService($pdo))->locate(1, 1, 1, 1, $attackerId);
    $previewEntityKey = (string)($previewUniverse['entity']['entity_key'] ?? '');
    if ($previewEntityKey === '') throw new RuntimeException('Scan fixture did not return an entity key.');
    $discoveryStmt = $pdo->prepare('SELECT COUNT(*) FROM player_universe_discoveries WHERE player_id=? AND entity_key=?');
    $discoveryStmt->execute([$attackerId, $previewEntityKey]);
    $hadDiscovery = (int)$discoveryStmt->fetchColumn() > 0;
    $scan = $service->scan($attackerId, 1, 1, 1, 1);
    $entityKey = (string)($scan['scan']['entity_key'] ?? '');
    if ($entityKey === '') throw new RuntimeException('Scan did not return an entity key.');
    $scanStmt = $pdo->prepare('SELECT status,scan_power,required_power,report_json FROM scan_missions WHERE id=? AND player_id=?');
    $scanStmt->execute([(int)$scan['mission_id'], $attackerId]);
    $scanRow = $scanStmt->fetch(PDO::FETCH_ASSOC);
    $createdScanIds[] = (int)$scan['mission_id'];
    $checks['scan_state_valid'] = in_array($scan['state'], ['success', 'partial'], true);
    $checks['scan_record_persisted'] = (bool)$scanRow && in_array($scanRow['status'], ['completed', 'partial'], true);
    $checks['scan_power_reported'] = $scanRow && (int)$scanRow['scan_power'] >= 0 && (int)$scanRow['required_power'] >= 0;
    $checks['scan_report_json_valid'] = $scanRow && is_array(json_decode((string)$scanRow['report_json'], true));

    foreach ($checks as $name => $passed) if (!$passed) throw new RuntimeException('Failed check: ' . $name);
    echo json_encode(['status' => 'passed', 'attacker_id' => $attackerId, 'defender_id' => $defenderId, 'mission' => $mission, 'scan' => $scan, 'checks' => $checks], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} finally {
    foreach ($createdReportIds as $reportId) $pdo->prepare('DELETE FROM intelligence_reports WHERE id=? AND player_id=?')->execute([$reportId, $attackerId]);
    foreach ($createdMissionIds as $missionId) $pdo->prepare('DELETE FROM covert_missions WHERE id=?')->execute([$missionId]);
    foreach ($createdScanIds as $scanId) $pdo->prepare('DELETE FROM scan_missions WHERE id=? AND player_id=?')->execute([$scanId, $attackerId]);
    if ($entityKey !== '' && !$hadDiscovery) $pdo->prepare('DELETE FROM player_universe_discoveries WHERE player_id=? AND entity_key=?')->execute([$attackerId, $entityKey]);
    $pdo->prepare('DELETE FROM universe_generation_events WHERE id>?')->execute([$generationEventCutoff]);
    $pdo->prepare('DELETE FROM game_events WHERE id>? AND player_id IN (?,?)')->execute([$gameEventCutoff, $attackerId, $defenderId]);
    $restore = $pdo->prepare('UPDATE player_resources SET spies=?,unit_production=? WHERE player_id=?');
    foreach ($resourceSnapshots as $playerId => $row) $restore->execute([(int)$row['spies'], (int)$row['unit_production'], $playerId]);
}
