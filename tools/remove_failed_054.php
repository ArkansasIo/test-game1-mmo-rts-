<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
$s = db()->prepare('DELETE FROM schema_migrations WHERE migration_key=? AND status=?');
$s->execute(['054_stargate_jumpgate_exploration', 'failed']);
echo "removed failed migration marker\n";
