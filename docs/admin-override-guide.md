# Administrative Override Guide

## Granting administrator rank

The current policy treats `players.rank_level >= 3` as administrator rank. The `Admintest` account currently exists with `rank_level = 1`, so it cannot issue override tokens until an authorized database administrator promotes it.

Run the following only through a protected database administration channel:

```sql
START TRANSACTION;

UPDATE players
SET rank_level = 3,
    rank_name = 'Administrator'
WHERE username = 'Admintest';

SELECT id, username, rank_level, rank_name
FROM players
WHERE username = 'Admintest';

COMMIT;
```

A safer CLI variant that verifies the account and refuses to update an unexpected row is:

```bash
mysql --defaults-extra-file=/secure/stargatewars-admin.cnf stargatewars <<'SQL'
START TRANSACTION;
UPDATE players
SET rank_level = 3, rank_name = 'Administrator'
WHERE username = 'Admintest' AND rank_level < 3;
SELECT ROW_COUNT() AS changed_rows;
SELECT id, username, rank_level, rank_name FROM players WHERE username = 'Admintest';
COMMIT;
SQL
```

The application should not expose this promotion as a normal player-facing action. If the game later receives an administrator-management page, it should require an already authenticated administrator, CSRF protection, an audit event, and a separate privilege-management permission.

## Complete `AdminOverrideService.php`

```php
<?php
declare(strict_types=1);
require_once __DIR__ . '/../../config/config.php';

final class AdminOverrideService
{
    public const ALLOWED_SCOPES = ['read_only_dashboard'];
    public const MAX_TTL_SECONDS = 900;

    public function __construct(private readonly PDO $pdo)
    {
    }

    public function issue(int $userId, string $scope, int $ttlSeconds, string $issuer): array
    {
        if ($userId < 1 || !in_array($scope, self::ALLOWED_SCOPES, true)) {
            throw new InvalidArgumentException('Invalid administrative override target or scope.');
        }
        if ($ttlSeconds < 30 || $ttlSeconds > self::MAX_TTL_SECONDS) {
            throw new InvalidArgumentException('Override lifetime must be between 30 and 900 seconds.');
        }
        $issuer = trim($issuer);
        if ($issuer === '' || strlen($issuer) > 120) {
            throw new InvalidArgumentException('A valid issuer label is required.');
        }

        $rawToken = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $tokenHash = hash('sha256', $rawToken);
        $expiresAt = (new DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->modify('+' . $ttlSeconds . ' seconds')->format('Y-m-d H:i:s');
        $ip = $this->clientIpBinary();

        $this->pdo->beginTransaction();
        try {
            $user = $this->pdo->prepare(
                'SELECT id, username, display_name, rank_level
                 FROM players WHERE id=? FOR UPDATE'
            );
            $user->execute([$userId]);
            $row = $user->fetch(PDO::FETCH_ASSOC);

            if (!$row || (int)($row['rank_level'] ?? 0) < 3) {
                throw new RuntimeException(
                    'Administrative override requires a commander with administrator rank.'
                );
            }

            $active = $this->pdo->prepare(
                "SELECT COUNT(*)
                 FROM admin_override_tokens
                 WHERE user_id=? AND scope=?
                   AND used_at IS NULL
                   AND revoked_at IS NULL
                   AND expires_at > UTC_TIMESTAMP()"
            );
            $active->execute([$userId, $scope]);
            if ((int)$active->fetchColumn() > 0) {
                throw new RuntimeException(
                    'An active override already exists for this commander and scope.'
                );
            }

            $insert = $this->pdo->prepare(
                'INSERT INTO admin_override_tokens
                 (token_hash,user_id,scope,expires_at,issued_by,issued_ip)
                 VALUES(?,?,?,?,?,?)'
            );
            $insert->execute([$tokenHash, $userId, $scope, $expiresAt, $issuer, $ip]);
            $tokenId = (int)$this->pdo->lastInsertId();

            $this->audit(
                $tokenId,
                $userId,
                'issued',
                $scope,
                ['ttl_seconds'=>$ttlSeconds, 'issuer'=>$issuer],
                $ip,
                null
            );

            $this->pdo->commit();
            return [
                'token_id'=>$tokenId,
                'token'=>$rawToken,
                'user'=>$row,
                'scope'=>$scope,
                'expires_at'=>$expiresAt,
            ];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function redeem(string $rawToken, ?string $userAgent = null): array
    {
        $rawToken = trim($rawToken);
        if (!preg_match('/^[A-Za-z0-9_-]{43}$/', $rawToken)) {
            throw new RuntimeException('Administrative override token is invalid or expired.');
        }

        $hash = hash('sha256', $rawToken);
        $ip = $this->clientIpBinary();

        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare(
                'SELECT t.*, p.username, p.display_name, p.rank_level,
                        r.name AS race
                 FROM admin_override_tokens t
                 JOIN players p ON p.id=t.user_id
                 JOIN races r ON r.id=p.race_id
                 WHERE t.token_hash=?
                 FOR UPDATE'
            );
            $stmt->execute([$hash]);
            $token = $stmt->fetch(PDO::FETCH_ASSOC);

            $now = new DateTimeImmutable('now', new DateTimeZone('UTC'));
            $invalid = !$token
                || $token['used_at'] !== null
                || $token['revoked_at'] !== null
                || new DateTimeImmutable(
                    (string)$token['expires_at'],
                    new DateTimeZone('UTC')
                ) <= $now
                || !in_array((string)$token['scope'], self::ALLOWED_SCOPES, true);

            if ($invalid) {
                if ($token) {
                    $this->audit(
                        (int)$token['id'],
                        (int)$token['user_id'],
                        'redeem_rejected',
                        (string)$token['scope'],
                        ['reason'=>'invalid_used_revoked_expired_or_scope'],
                        $ip,
                        $userAgent
                    );
                }
                $this->pdo->commit();
                throw new RuntimeException(
                    'Administrative override token is invalid or expired.'
                );
            }

            $usedAt = $now->format('Y-m-d H:i:s');
            $update = $this->pdo->prepare(
                'UPDATE admin_override_tokens
                 SET used_at=?, redeemed_ip=?, redeemed_user_agent=?
                 WHERE id=? AND used_at IS NULL AND revoked_at IS NULL'
            );
            $update->execute([
                $usedAt,
                $ip,
                substr((string)$userAgent, 0, 512),
                (int)$token['id'],
            ]);

            if ($update->rowCount() !== 1) {
                throw new RuntimeException(
                    'Administrative override token could not be redeemed.'
                );
            }

            $this->audit(
                (int)$token['id'],
                (int)$token['user_id'],
                'redeemed',
                (string)$token['scope'],
                [],
                $ip,
                $userAgent
            );

            $this->pdo->commit();
            return [
                'id'=>(int)$token['user_id'],
                'username'=>$token['username'],
                'display_name'=>$token['display_name'],
                'race'=>$token['race'],
                'rank_level'=>(int)$token['rank_level'],
                'rank_name'=>'Administrator',
                'override_scope'=>$token['scope'],
                'override_expires_at'=>$token['expires_at'],
                'override_token_id'=>(int)$token['id'],
            ];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function revoke(int $tokenId, string $actor): bool
    {
        if ($tokenId < 1) {
            throw new InvalidArgumentException('Invalid override token id.');
        }

        $ip = $this->clientIpBinary();
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare(
                'SELECT id,user_id,scope
                 FROM admin_override_tokens WHERE id=? FOR UPDATE'
            );
            $stmt->execute([$tokenId]);
            $token = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$token) {
                $this->pdo->commit();
                return false;
            }

            $changed = $this->pdo->prepare(
                'UPDATE admin_override_tokens
                 SET revoked_at=UTC_TIMESTAMP()
                 WHERE id=? AND revoked_at IS NULL AND used_at IS NULL'
            );
            $changed->execute([$tokenId]);

            if ($changed->rowCount() === 1) {
                $this->audit(
                    $tokenId,
                    (int)$token['user_id'],
                    'revoked',
                    (string)$token['scope'],
                    ['actor'=>substr($actor, 0, 120)],
                    $ip,
                    null
                );
            }

            $this->pdo->commit();
            return $changed->rowCount() === 1;
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    private function audit(
        int $tokenId,
        ?int $userId,
        string $action,
        ?string $scope,
        array $metadata,
        ?string $ip,
        ?string $userAgent
    ): void {
        $stmt = $this->pdo->prepare(
            'INSERT INTO admin_override_audit
             (token_id,user_id,action,scope,ip_address,user_agent,metadata)
             VALUES(?,?,?,?,?,?,?)'
        );
        $stmt->execute([
            $tokenId ?: null,
            $userId ?: null,
            $action,
            $scope,
            $ip,
            $userAgent ? substr($userAgent, 0, 512) : null,
            json_encode($metadata, JSON_THROW_ON_ERROR),
        ]);
    }

    private function clientIpBinary(): ?string
    {
        $ip = (string)($_SERVER['REMOTE_ADDR'] ?? '');
        return filter_var($ip, FILTER_VALIDATE_IP) ? inet_pton($ip) : null;
    }
}
```

## How the transactional locking works

The service uses MariaDB/InnoDB transactions. In `issue()`, `SELECT ... FROM players WHERE id=? FOR UPDATE` locks the target player row until commit or rollback. This serializes concurrent issuance attempts for the same commander. The active-token check and insert therefore run inside one transaction. Two simultaneous issuers cannot both safely pass the serialized target-user check and create conflicting active tokens.

In `redeem()`, the token row is selected with `FOR UPDATE` after looking up the stored hash. The first request obtains the row lock, confirms that the token is unused, unrevoked, unexpired, and in an allowed scope, then updates `used_at` in the same transaction. A concurrent request waits for that lock; after the first transaction commits, its own `FOR UPDATE` sees `used_at` populated and rejects the token. This prevents double redemption.

The conditional update provides a second defense:

```sql
UPDATE admin_override_tokens
SET used_at = ?, redeemed_ip = ?, redeemed_user_agent = ?
WHERE id = ?
  AND used_at IS NULL
  AND revoked_at IS NULL;
```

The code requires exactly one affected row. If another operation has already consumed or revoked the token, the update affects zero rows and redemption fails.

`revoke()` follows the same pattern: it locks the token row, conditionally sets `revoked_at`, writes an audit record, and commits atomically. If any audit insert or update fails, the exception handler rolls the entire transaction back so the token state and audit history cannot diverge.

## Issuing an override after promotion

After promoting the account, use the server-side CLI:

```bash
php tools/admin_override.php issue 7012 300 read_only_dashboard operator-label
```

The command issues a five-minute, read-only token for `Admintest`. It prints the raw token only once. The token should be handled like a password and never committed to source control, pasted into chat, or placed in a URL.
