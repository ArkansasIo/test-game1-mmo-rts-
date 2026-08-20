<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../02_Gameplay/WorldService.php';
require_once __DIR__ . '/../includes/services/PlanetService.php';

$pdo = db();
$playerId = 1;
$world = new WorldService($pdo);
$beforeResources = (int)$pdo->query("SELECT naquadah FROM player_resources WHERE player_id={$playerId}")->fetchColumn();
$planet = $pdo->query("SELECT id FROM universe_planets WHERE is_colonizable=1 AND is_occupied=0 ORDER BY id LIMIT 1")->fetchColumn();
if (!$planet) { fwrite(STDERR, "No unoccupied fixture planet available\n"); exit(1); }
$planetId = (int)$planet;
$beforePlanet = $pdo->prepare('SELECT is_occupied FROM universe_planets WHERE id=?');
$beforePlanet->execute([$planetId]);
$occupiedBefore = (int)$beforePlanet->fetchColumn();
$colonyId = null;
try {
    $snapshot = $world->universePlanetsSnapshot($playerId, $planetId);
    if ($snapshot['state'] !== 'ready' || !$snapshot['selected']) throw new RuntimeException('Snapshot not ready');
    $selected = $snapshot['selected'];
    $expectedCapacity = (int)floor((int)$selected['slots'] * (float)$selected['infrastructure_factor'] * (float)$selected['life_support_factor']);
    if ((int)$selected['colonization_capacity'] !== $expectedCapacity) throw new RuntimeException('Capacity formula mismatch');
    if (!array_key_exists('moons', $selected) || !array_key_exists('biome', $selected)) throw new RuntimeException('Planet profile incomplete');
    $details = (new WorldService($pdo))->getPlanetDetails($planetId);
    if ((int)$details['id'] !== $planetId || !isset($details['moons'])) throw new RuntimeException('Inspection contract incomplete');
    if (!$selected['eligible']) throw new RuntimeException('Fixture planet unexpectedly ineligible');
    $result = (new PlanetService($pdo))->colonize($playerId, $planetId, 'Contract Test Colony');
    $colonyId = (int)$result['colony_id'];
    $r = $pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=?'); $r->execute([$playerId]);
    if ((int)$r->fetchColumn() !== $beforeResources - 50000) throw new RuntimeException('Resource debit mismatch');
    $p = $pdo->prepare('SELECT is_occupied FROM universe_planets WHERE id=?'); $p->execute([$planetId]);
    if ((int)$p->fetchColumn() !== 1) throw new RuntimeException('Planet occupancy was not persisted');
    $c = $pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='planet_colonize'"); $c->execute([$playerId]);
    if (!$c->fetchColumn()) throw new RuntimeException('Colonization cooldown missing');
    echo "PASS: Universe Planets inspection, capacity, colonization, resource debit, cooldown, and persistence verified\n";
} finally {
    if ($colonyId) { $pdo->prepare('DELETE FROM player_colonies WHERE id=?')->execute([$colonyId]); }
    $pdo->prepare('UPDATE universe_planets SET is_occupied=? WHERE id=?')->execute([$occupiedBefore, $planetId]);
    $pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key='planet_colonize'")->execute([$playerId]);
    $pdo->prepare("DELETE FROM game_events WHERE player_id=? AND event_type='planet_colonized' AND JSON_EXTRACT(payload,'$.planet_id')=?")->execute([$playerId, $planetId]);
    $pdo->prepare('UPDATE player_resources SET naquadah=? WHERE player_id=?')->execute([$beforeResources, $playerId]);
}
