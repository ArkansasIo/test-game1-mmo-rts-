<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo = db();
$checks = [];
$stmt = $pdo->query('SELECT COUNT(*) FROM player_empire_limits WHERE max_planets=100000 AND max_moons=100000 AND homeworld_required=1');
$checks['limits_are_100000'] = (int)$stmt->fetchColumn() === (int)$pdo->query('SELECT COUNT(*) FROM players')->fetchColumn();
$stmt = $pdo->query('SELECT COUNT(*) FROM (SELECT player_id FROM empire_homeworlds GROUP BY player_id HAVING COUNT(*) > 1) duplicate_homeworlds');
$checks['one_homeworld_per_player'] = (int)$stmt->fetchColumn() === 0;
$stmt = $pdo->query('SELECT COUNT(*) FROM empire_homeworlds h LEFT JOIN player_colonies c ON c.id=h.colony_id WHERE c.id IS NULL');
$checks['homeworld_foreign_keys_resolve'] = (int)$stmt->fetchColumn() === 0;
$failures = array_keys(array_filter($checks, static fn(bool $ok): bool => !$ok));
echo json_encode(['status' => $failures ? 'failed' : 'passed', 'checks' => $checks, 'failures' => $failures], JSON_PRETTY_PRINT) . PHP_EOL;
exit($failures ? 1 : 0);
