<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
$pdo=db();
$s=$pdo->prepare('SELECT migration_key,status,checksum,applied_at FROM schema_migrations WHERE migration_key=?');
$s->execute(['055_stellar_interstellar_taxonomy']);
print_r($s->fetch(PDO::FETCH_ASSOC));
foreach (['stellar_class_catalog','stellar_system_type_catalog','interstellar_object_type_catalog','universe_interstellar_objects'] as $t) {
  try { echo $t . ': ' . $pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn() . PHP_EOL; } catch(Throwable $e) { echo $t . ': missing' . PHP_EOL; }
}
