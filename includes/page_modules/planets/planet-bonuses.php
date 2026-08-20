<?php
declare(strict_types=1);

function stargatewars_planets_planet_bonuses_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/planets/planet-bonuses.php'; }
function stargatewars_planets_planet_bonuses_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/planets/planet-bonuses.php'; }
function stargatewars_planets_planet_bonuses_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/planets/planet-bonuses.php'; }
function stargatewars_planets_planet_bonuses_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/planets/planet-bonuses.php'; }
function stargatewars_planets_planet_bonuses_actions(): array { return stargatewars_planets_planet_bonuses_systems()['actions'] ?? []; }
function stargatewars_planets_planet_bonuses_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_planets_planet_bonuses_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_planets_planet_bonuses_preview(array $context = []): array {
    return ['route' => 'planet-bonuses', 'title' => 'Planet Bonuses', 'logic' => stargatewars_planets_planet_bonuses_logic(), 'features' => stargatewars_planets_planet_bonuses_features(), 'design' => stargatewars_planets_planet_bonuses_design(), 'systems' => stargatewars_planets_planet_bonuses_systems(), 'context' => $context];
}
