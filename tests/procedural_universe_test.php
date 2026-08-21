<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/ProceduralUniverseService.php';

$pdo = db();
$playerId = (int)($pdo->query("SELECT id FROM players ORDER BY id LIMIT 1")->fetchColumn() ?: 0);
if ($playerId < 1) throw new RuntimeException('No player exists for procedural universe test.');
$service = new ProceduralUniverseService($pdo);
$a = $service->locate(1,1,1,3,$playerId);
$b = $service->locate(1,1,1,3,$playerId);
if ($a['entity']['entity_key'] !== $b['entity']['entity_key'] || $a['entity']['name'] !== $b['entity']['name']) throw new RuntimeException('Deterministic entity mismatch.');
if (($a['galaxy']['entity_type'] ?? '') !== 'galaxy' || ($a['sector']['entity_type'] ?? '') !== 'sector' || ($a['system']['entity_type'] ?? '') !== 'system' || ($a['entity']['entity_type'] ?? '') !== 'planet') throw new RuntimeException('Universe hierarchy mismatch.');
$scan = $service->scan($playerId,1,1,1,3);
if (($scan['scan']['state'] ?? '') !== 'success') throw new RuntimeException('Scan did not produce success state.');
$again = $service->locate(1,1,1,3,$playerId);
if (!isset($again['entity']['discovery'])) throw new RuntimeException('Discovery was not persisted.');
$invalid = $service->locate(999999,1,1,3,$playerId);
if (($invalid['state'] ?? '') !== 'empty') throw new RuntimeException('Invalid coordinates were not rejected.');
echo "procedural_universe_test: PASS\n";
