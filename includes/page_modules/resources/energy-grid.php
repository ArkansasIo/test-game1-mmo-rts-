<?php
declare(strict_types=1);

function stargatewars_resources_energy_grid_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/resources/energy-grid.php'; }
function stargatewars_resources_energy_grid_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/resources/energy-grid.php'; }
function stargatewars_resources_energy_grid_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/resources/energy-grid.php'; }
function stargatewars_resources_energy_grid_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/resources/energy-grid.php'; }
function stargatewars_resources_energy_grid_actions(): array { return stargatewars_resources_energy_grid_systems()['actions'] ?? []; }
function stargatewars_resources_energy_grid_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_resources_energy_grid_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_resources_energy_grid_preview(array $context = []): array {
    return ['route' => 'energy-grid', 'title' => 'Energy Grid', 'logic' => stargatewars_resources_energy_grid_logic(), 'features' => stargatewars_resources_energy_grid_features(), 'design' => stargatewars_resources_energy_grid_design(), 'systems' => stargatewars_resources_energy_grid_systems(), 'context' => $context];
}
