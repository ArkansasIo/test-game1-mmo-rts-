<?php
declare(strict_types=1);

function stargatewars_military_military_units_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/military/military-units.php'; }
function stargatewars_military_military_units_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/military/military-units.php'; }
function stargatewars_military_military_units_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/military/military-units.php'; }
function stargatewars_military_military_units_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/military/military-units.php'; }
function stargatewars_military_military_units_actions(): array { return stargatewars_military_military_units_systems()['actions'] ?? []; }
function stargatewars_military_military_units_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_military_military_units_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_military_military_units_preview(array $context = []): array {
    return ['route' => 'military-units', 'title' => 'Units', 'logic' => stargatewars_military_military_units_logic(), 'features' => stargatewars_military_military_units_features(), 'design' => stargatewars_military_military_units_design(), 'systems' => stargatewars_military_military_units_systems(), 'context' => $context];
}
