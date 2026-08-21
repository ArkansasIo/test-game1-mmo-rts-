<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/services/GameMechanicsService.php';
require_once __DIR__ . '/../includes/services/DesignCatalogService.php';

$mechanics = new GameMechanicsService();
$catalog = $mechanics->catalog();
$required = ['resources','biomes','buildings','technologies','ships','defenses','troops','missions','officers','events'];
foreach ($required as $key) {
    if (empty($catalog[$key]) || !is_array($catalog[$key])) throw new RuntimeException("Missing catalog domain: {$key}");
}
if (count($catalog['resources']) < 8) throw new RuntimeException('Core resource catalog is incomplete.');
if (count($catalog['ships']) < 10) throw new RuntimeException('Ship catalog is incomplete.');
if ($mechanics->production(3600, 3600, 1.0, 0.0) !== 3600.0) throw new RuntimeException('Production formula failed.');
if ($mechanics->cost('buildings','metal_mine',2)['metal'] <= 60) throw new RuntimeException('Cost growth formula failed.');
if ($mechanics->storageCapacity(10) <= $mechanics->storageCapacity(9)) throw new RuntimeException('Storage growth formula failed.');
if ($mechanics->fleetPower(['light_fighter'=>10])['attack'] !== 500) throw new RuntimeException('Fleet power formula failed.');
if ($mechanics->combatPower(10,50,1.1,1.0,1.0,1.0) !== 550) throw new RuntimeException('Combat power formula failed.');
if ($mechanics->rankingScore(100,200,300,40,10) !== 630) throw new RuntimeException('Ranking formula failed.');
if ($mechanics->loot(1000,0.5,400) !== 400) throw new RuntimeException('Loot cap formula failed.');
if ($mechanics->debris(1000,500,0.3)['metal'] !== 300) throw new RuntimeException('Debris formula failed.');
echo "design_catalog_mechanics_test: PASS\n";
