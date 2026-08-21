<?php
declare(strict_types=1);

/**
 * Universe Civilization: Empire at Wars database deployment runner.
 *
 * Safe defaults: --plan only. Use --apply to execute migrations.
 * The runner applies numbered SQL files in natural numeric order, tracks
 * checksums in schema_migrations, rejects modified applied files, and skips
 * the local demo account unless --include-local-demo is explicitly provided.
 */

require_once __DIR__ . '/../config/config.php';

$options = getopt('', ['apply', 'plan', 'include-local-demo', 'from:', 'to:', 'help']);
if (isset($options['help'])) {
    echo "Usage: php tools/deploy_database.php [--plan|--apply] [--from=000] [--to=037] [--include-local-demo]\n";
    exit(0);
}
$apply = isset($options['apply']);
$includeLocalDemo = isset($options['include-local-demo']);
$from = isset($options['from']) ? (int)$options['from'] : 0;
$to = isset($options['to']) ? (int)$options['to'] : PHP_INT_MAX;
if ($from < 0 || $to < $from) {
    fwrite(STDERR, "Invalid migration range.\n");
    exit(2);
}

$root = dirname(__DIR__);
$sqlDir = $root . '/sql';
$logDir = $root . '/storage/logs';
if (!is_dir($logDir) && !mkdir($logDir, 0775, true) && !is_dir($logDir)) {
    throw new RuntimeException('Unable to create log directory: ' . $logDir);
}
$logFile = $logDir . '/database-deploy-' . date('Y-m-d') . '.log';

function deployLog(string $message): void
{
    global $logFile;
    $line = '[' . date('c') . '] ' . $message . PHP_EOL;
    file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
    fwrite(STDOUT, $line);
}

function connectWithoutDatabase(): PDO
{
    return new PDO('mysql:host=' . DB_HOST . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => true,
    ]);
}

function connectDatabase(): PDO
{
    return new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => true,
    ]);
}

function migrationNumber(string $file): int
{
    if (!preg_match('/^(\d+)_.*\.sql$/', $file, $m)) {
        return PHP_INT_MAX;
    }
    return (int)$m[1];
}

function migrationKey(string $file): string
{
    return pathinfo($file, PATHINFO_FILENAME);
}

try {
    $server = connectWithoutDatabase();
    $server->exec('CREATE DATABASE IF NOT EXISTS `' . str_replace('`', '``', DB_NAME) . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    $pdo = connectDatabase();
    $pdo->exec("SET NAMES utf8mb4");
    $pdo->exec("SET SESSION time_zone = '+00:00'");

    $files = glob($sqlDir . '/*.sql') ?: [];
    $migrations = [];
    foreach ($files as $path) {
        $file = basename($path);
        $number = migrationNumber($file);
        if ($number === PHP_INT_MAX || $number < $from || $number > $to) {
            continue;
        }
        if (!$includeLocalDemo && $file === '014_local_demo_account.sql') {
            deployLog('SKIP local demo migration ' . $file . ' (use --include-local-demo to include it)');
            continue;
        }
        $migrations[] = [
            'file' => $file,
            'path' => $path,
            'number' => $number,
            'key' => migrationKey($file),
            'checksum' => hash_file('sha256', $path),
            'sql' => file_get_contents($path),
        ];
    }
    usort($migrations, static fn(array $a, array $b): int => [$a['number'], $a['file']] <=> [$b['number'], $b['file']]);

    $schemaMigrationSql = "CREATE TABLE IF NOT EXISTS schema_migrations (\n        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,\n        migration_key VARCHAR(160) NOT NULL UNIQUE,\n        filename VARCHAR(255) NOT NULL,\n        checksum CHAR(64) NOT NULL,\n        status ENUM('applied','failed') NOT NULL,\n        execution_ms INT UNSIGNED NOT NULL DEFAULT 0,\n        applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,\n        error_message TEXT NULL,\n        KEY idx_schema_migrations_status (status),\n        KEY idx_schema_migrations_applied_at (applied_at)\n    ) ENGINE=InnoDB";
    if (!$apply) {
        deployLog('PLAN mode; no SQL mutations will be executed.');
        deployLog('Database: ' . DB_NAME . '@' . DB_HOST . '; migrations=' . count($migrations));
        foreach ($migrations as $migration) {
            deployLog(sprintf('PLAN %03d %s checksum=%s', $migration['number'], $migration['file'], $migration['checksum']));
        }
        exit(0);
    }

    $pdo->exec($schemaMigrationSql);
    $read = $pdo->query('SELECT migration_key, filename, checksum, status FROM schema_migrations')->fetchAll();
    $applied = [];
    foreach ($read as $row) {
        $applied[$row['migration_key']] = $row;
    }

    $lock = $pdo->query("SELECT GET_LOCK('universe_civilization_database_deploy', 60)")->fetchColumn();
    if ((int)$lock !== 1) {
        throw new RuntimeException('Another database deployment is already running.');
    }
    try {
        foreach ($migrations as $migration) {
            $previous = $applied[$migration['key']] ?? null;
            if ($previous && $previous['checksum'] !== $migration['checksum']) {
                throw new RuntimeException('Checksum drift detected for applied migration ' . $migration['file'] . '. Restore the original file or perform a reviewed repair.');
            }
            if ($previous && $previous['status'] === 'applied') {
                deployLog('SKIP applied ' . $migration['file']);
                continue;
            }

            $started = microtime(true);
            deployLog('APPLY ' . $migration['file']);
            try {
                // MariaDB/MySQL DDL can implicitly commit, so migrations run without PDO transaction wrappers.
                $pdo->exec((string)$migration['sql']);
                $elapsed = (int)round((microtime(true) - $started) * 1000);
                $stmt = $pdo->prepare("INSERT INTO schema_migrations (migration_key, filename, checksum, status, execution_ms, error_message) VALUES (?, ?, ?, 'applied', ?, NULL) ON DUPLICATE KEY UPDATE filename=VALUES(filename), checksum=VALUES(checksum), status='applied', execution_ms=VALUES(execution_ms), applied_at=CURRENT_TIMESTAMP, error_message=NULL");
                $stmt->execute([$migration['key'], $migration['file'], $migration['checksum'], $elapsed]);
                deployLog('DONE ' . $migration['file'] . ' ' . $elapsed . 'ms');
            } catch (Throwable $e) {
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
                $message = mb_substr($e->getMessage(), 0, 2000);
                $failed = $pdo->prepare("INSERT INTO schema_migrations (migration_key, filename, checksum, status, execution_ms, error_message) VALUES (?, ?, ?, 'failed', ?, ?) ON DUPLICATE KEY UPDATE filename=VALUES(filename), checksum=VALUES(checksum), status='failed', execution_ms=VALUES(execution_ms), applied_at=CURRENT_TIMESTAMP, error_message=VALUES(error_message)");
                $failed->execute([$migration['key'], $migration['file'], $migration['checksum'], (int)round((microtime(true) - $started) * 1000), $message]);
                deployLog('FAIL ' . $migration['file'] . ': ' . $message);
                throw $e;
            }
        }
    } finally {
        $pdo->query("SELECT RELEASE_LOCK('universe_civilization_database_deploy')");
    }
    deployLog('DEPLOYMENT COMPLETE');
} catch (Throwable $e) {
    deployLog('DEPLOYMENT ABORTED: ' . $e->getMessage());
    exit(1);
}
