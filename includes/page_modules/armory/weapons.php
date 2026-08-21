<?php
declare(strict_types=1);

function stargatewars_armory_weapons_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/armory/weapons.php'; }
function stargatewars_armory_weapons_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/armory/weapons.php'; }
function stargatewars_armory_weapons_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/armory/weapons.php'; }
function stargatewars_armory_weapons_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/armory/weapons.php'; }
function stargatewars_armory_weapons_actions(): array { return stargatewars_armory_weapons_systems()['actions'] ?? []; }
function stargatewars_armory_weapons_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_armory_weapons_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_armory_weapons_preview(array $context = []): array {
    return ['route' => 'weapons', 'title' => 'Weapon Inventory', 'logic' => stargatewars_armory_weapons_logic(), 'features' => stargatewars_armory_weapons_features(), 'design' => stargatewars_armory_weapons_design(), 'systems' => stargatewars_armory_weapons_systems(), 'context' => $context];
}

function stargatewars_armory_weapons_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/armory/weapons.php'; }
function stargatewars_armory_weapons_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/armory/weapons.php'; }
function stargatewars_armory_weapons_state_transitions(): array { return stargatewars_armory_weapons_logic()['state_transitions'] ?? []; }
