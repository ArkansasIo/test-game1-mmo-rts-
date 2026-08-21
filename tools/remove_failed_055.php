<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
$s = db()->prepare('DELETE FROM schema_migrations WHERE migration_key=? AND status=?');
$s->execute(['055_stellar_interstellar_taxonomy', 'failed']);
echo "removed failed 055 migration marker\n";
