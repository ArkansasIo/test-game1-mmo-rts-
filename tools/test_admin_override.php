<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/services/AdminOverrideService.php';

$pdo = db() ?? throw new RuntimeException('Database unavailable.');
$service = new AdminOverrideService($pdo);
$userId = (int)($argv[1] ?? 7012);
$first = $service->issue($userId, 'read_only_dashboard', 30, 'automated-test');
$redeemed = $service->redeem($first['token'], 'automated-test-agent');
if ((int)$redeemed['id'] !== $userId || $redeemed['override_scope'] !== 'read_only_dashboard') throw new RuntimeException('Redemption payload mismatch.');
try { $service->redeem($first['token'], 'automated-test-agent'); throw new RuntimeException('Single-use token redeemed twice.'); } catch (RuntimeException $e) { if ($e->getMessage() === 'Single-use token redeemed twice.') throw $e; }
$second = $service->issue($userId, 'read_only_dashboard', 30, 'automated-test');
if (!$service->revoke((int)$second['token_id'], 'automated-test')) throw new RuntimeException('Revocation failed.');
try { $service->redeem($second['token'], 'automated-test-agent'); throw new RuntimeException('Revoked token redeemed.'); } catch (RuntimeException $e) { if ($e->getMessage() === 'Revoked token redeemed.') throw $e; }
echo "admin_override_tests=passed\n";
