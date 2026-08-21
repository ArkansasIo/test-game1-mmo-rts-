<?php
declare(strict_types=1);

function stargatewars_planets_planet_list_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/planets/planet-list.php'; }
function stargatewars_planets_planet_list_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/planets/planet-list.php'; }
function stargatewars_planets_planet_list_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/planets/planet-list.php'; }
function stargatewars_planets_planet_list_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/planets/planet-list.php'; }
function stargatewars_planets_planet_list_actions(): array { return stargatewars_planets_planet_list_systems()['actions'] ?? []; }
function stargatewars_planets_planet_list_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_planets_planet_list_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_planets_planet_list_preview(array $context = []): array {
    return ['route' => 'planet-list', 'title' => 'Planet List', 'logic' => stargatewars_planets_planet_list_logic(), 'features' => stargatewars_planets_planet_list_features(), 'design' => stargatewars_planets_planet_list_design(), 'systems' => stargatewars_planets_planet_list_systems(), 'context' => $context];
}

function stargatewars_planets_planet_list_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/planets/planet-list.php'; }
function stargatewars_planets_planet_list_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/planets/planet-list.php'; }
function stargatewars_planets_planet_list_state_transitions(): array { return stargatewars_planets_planet_list_logic()['state_transitions'] ?? []; }
