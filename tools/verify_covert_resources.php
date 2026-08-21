<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/CovertTechnologyService.php';
require_once __DIR__ . '/../includes/services/TechnologyTreeService.php';
$pdo = db();
$covert = (new CovertTechnologyService($pdo))->snapshot(1);
$resource = $pdo->prepare('SELECT metal,crystal,deuterium,naquadah,energy,dark_matter,food,water,population,untrained_units,spies,anti_spies,covert_capacity FROM player_resources WHERE player_id=?');
$resource->execute([1]);
echo json_encode([
    'covert' => [
        'technologies' => $covert['technologies'] ?? [],
        'branch_systems' => $covert['branch_systems'] ?? [],
        'agent_systems' => $covert['agent_systems'] ?? [],
        'queue' => $covert['queue'] ?? [],
        'queue_used' => $covert['queue_used'] ?? 0,
        'queue_capacity' => $covert['queue_capacity'] ?? null,
        'queue_available' => $covert['queue_available'] ?? null,
        'infiltration_modifier' => $covert['infiltration_modifier'] ?? 0,
    ],
    'resources' => $resource->fetch(PDO::FETCH_ASSOC),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
