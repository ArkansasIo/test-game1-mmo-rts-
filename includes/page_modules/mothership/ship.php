<?php
declare(strict_types=1);

function stargatewars_mothership_ship_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/mothership/ship.php'; }
function stargatewars_mothership_ship_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/mothership/ship.php'; }
function stargatewars_mothership_ship_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/mothership/ship.php'; }
function stargatewars_mothership_ship_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/mothership/ship.php'; }
function stargatewars_mothership_ship_actions(): array { return stargatewars_mothership_ship_systems()['actions'] ?? []; }
function stargatewars_mothership_ship_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_mothership_ship_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_mothership_ship_preview(array $context = []): array {
    return ['route' => 'ship', 'title' => 'Mothership', 'logic' => stargatewars_mothership_ship_logic(), 'features' => stargatewars_mothership_ship_features(), 'design' => stargatewars_mothership_ship_design(), 'systems' => stargatewars_mothership_ship_systems(), 'context' => $context];
}

function stargatewars_mothership_ship_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/mothership/ship.php'; }
function stargatewars_mothership_ship_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/mothership/ship.php'; }
function stargatewars_mothership_ship_state_transitions(): array { return stargatewars_mothership_ship_logic()['state_transitions'] ?? []; }
