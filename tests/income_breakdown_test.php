<?php
declare(strict_types=1);

$root = dirname(__DIR__);
require_once $root . '/config/config.php';
require_once $root . '/includes/services/EconomyService.php';

$pdo = db();
if (!$pdo instanceof PDO) {
    fwrite(STDERR, "database_unavailable\n");
    exit(2);
}
$stmt = $pdo->prepare('SELECT id FROM players WHERE username IN (?, ?) ORDER BY username LIMIT 1');
$stmt->execute(['demo_commander', 'demo']);
$playerId = (int)$stmt->fetchColumn();
if ($playerId < 1) {
    fwrite(STDERR, "seed_player_missing\n");
    exit(2);
}
$service = new EconomyService($pdo);
$income = $service->incomeBreakdown($playerId);
$colonies = $service->colonyComparison($playerId);
$checks = [
    'formula' => $income['formula'] === 'settlement = (base production × race modifier × government modifier × technology) − upkeep',
    'gross_output_numeric' => is_int($income['gross_output']),
    'net_settlement_numeric' => is_int($income['net_settlement']),
    'upkeep_shape' => isset($income['upkeep']['food'], $income['upkeep']['water'], $income['upkeep']['energy']),
    'colony_rows_are_owned' => is_array($colonies),
];
$failed = array_keys(array_filter($checks, static fn(bool $ok): bool => !$ok));
echo json_encode(['status'=>$failed ? 'failed' : 'passed','player_id'=>$playerId,'income'=>$income,'colonies'=>$colonies,'checks'=>$checks,'failures'=>$failed], JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;
exit($failed ? 1 : 0);
?>

