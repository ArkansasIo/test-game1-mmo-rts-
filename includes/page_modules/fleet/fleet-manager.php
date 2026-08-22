<?php
declare(strict_types=1);

function stargatewars_fleet_fleet_manager_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/fleet/fleet-manager.php'; }
function stargatewars_fleet_fleet_manager_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/fleet/fleet-manager.php'; }
function stargatewars_fleet_fleet_manager_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/fleet/fleet-manager.php'; }
function stargatewars_fleet_fleet_manager_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/fleet/fleet-manager.php'; }
function stargatewars_fleet_fleet_manager_actions(): array { return stargatewars_fleet_fleet_manager_systems()['actions'] ?? []; }
function stargatewars_fleet_fleet_manager_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_fleet_fleet_manager_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_fleet_fleet_manager_preview(array $context = []): array {
    return ['route' => 'fleet-manager', 'title' => 'Fleet Manager', 'logic' => stargatewars_fleet_fleet_manager_logic(), 'features' => stargatewars_fleet_fleet_manager_features(), 'design' => stargatewars_fleet_fleet_manager_design(), 'systems' => stargatewars_fleet_fleet_manager_systems(), 'context' => $context];
}
