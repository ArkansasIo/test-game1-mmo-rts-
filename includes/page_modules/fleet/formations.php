<?php
declare(strict_types=1);

function stargatewars_fleet_formations_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/fleet/formations.php'; }
function stargatewars_fleet_formations_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/fleet/formations.php'; }
function stargatewars_fleet_formations_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/fleet/formations.php'; }
function stargatewars_fleet_formations_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/fleet/formations.php'; }
function stargatewars_fleet_formations_actions(): array { return stargatewars_fleet_formations_systems()['actions'] ?? []; }
function stargatewars_fleet_formations_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_fleet_formations_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_fleet_formations_preview(array $context = []): array {
    return ['route' => 'formations', 'title' => 'Formations', 'logic' => stargatewars_fleet_formations_logic(), 'features' => stargatewars_fleet_formations_features(), 'design' => stargatewars_fleet_formations_design(), 'systems' => stargatewars_fleet_formations_systems(), 'context' => $context];
}
