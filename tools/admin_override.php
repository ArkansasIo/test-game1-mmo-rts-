<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
require_once __DIR__ . '/../includes/services/AdminOverrideService.php';

$pdo = db() ?? throw new RuntimeException('Database unavailable.');
$service = new AdminOverrideService($pdo);
$command = $argv[1] ?? 'help';

try {
    if ($command === 'issue') {
        $userId = (int)($argv[2] ?? 0);
        $ttl = (int)($argv[3] ?? 300);
        $scope = (string)($argv[4] ?? 'read_only_dashboard');
        $issuer = (string)($argv[5] ?? 'local-cli');
        $result = $service->issue($userId, $scope, $ttl, $issuer);
        echo "token_id={$result['token_id']}\n";
        echo "user={$result['user']['username']}\n";
        echo "scope={$result['scope']}\n";
        echo "expires_at={$result['expires_at']} UTC\n";
        echo "token={$result['token']}\n";
        echo "redeem_with: curl -sS -X POST -d token={$result['token']} https://HOST/admin_override.php\n";
        exit(0);
    }
    if ($command === 'revoke') {
        $tokenId = (int)($argv[2] ?? 0);
        $actor = (string)($argv[3] ?? 'local-cli');
        echo $service->revoke($tokenId, $actor) ? "revoked\n" : "not-active\n";
        exit(0);
    }
    fwrite(STDERR, "Usage:\n  php tools/admin_override.php issue USER_ID [TTL_SECONDS] [SCOPE] [ISSUER]\n  php tools/admin_override.php revoke TOKEN_ID [ACTOR]\n");
    exit(2);
} catch (Throwable $e) {
    fwrite(STDERR, 'ERROR: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
