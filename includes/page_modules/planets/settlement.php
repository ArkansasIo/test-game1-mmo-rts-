<?php
declare(strict_types=1);

function stargatewars_planets_settlement_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/planets/settlement.php'; }
function stargatewars_planets_settlement_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/planets/settlement.php'; }
function stargatewars_planets_settlement_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/planets/settlement.php'; }
function stargatewars_planets_settlement_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/planets/settlement.php'; }
function stargatewars_planets_settlement_actions(): array { return stargatewars_planets_settlement_systems()['actions'] ?? []; }
function stargatewars_planets_settlement_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_planets_settlement_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_planets_settlement_preview(array $context = []): array {
    return ['route' => 'settlement', 'title' => 'Settlement & Power Grid', 'logic' => stargatewars_planets_settlement_logic(), 'features' => stargatewars_planets_settlement_features(), 'design' => stargatewars_planets_settlement_design(), 'systems' => stargatewars_planets_settlement_systems(), 'context' => $context];
}

function stargatewars_planets_settlement_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/planets/settlement.php'; }
function stargatewars_planets_settlement_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/planets/settlement.php'; }
function stargatewars_planets_settlement_state_transitions(): array { return stargatewars_planets_settlement_logic()['state_transitions'] ?? []; }
