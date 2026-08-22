<?php
declare(strict_types=1);

function stargatewars_fleet_motherships_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/fleet/motherships.php'; }
function stargatewars_fleet_motherships_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/fleet/motherships.php'; }
function stargatewars_fleet_motherships_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/fleet/motherships.php'; }
function stargatewars_fleet_motherships_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/fleet/motherships.php'; }
function stargatewars_fleet_motherships_actions(): array { return stargatewars_fleet_motherships_systems()['actions'] ?? []; }
function stargatewars_fleet_motherships_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_fleet_motherships_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_fleet_motherships_preview(array $context = []): array {
    return ['route' => 'motherships', 'title' => 'Motherships', 'logic' => stargatewars_fleet_motherships_logic(), 'features' => stargatewars_fleet_motherships_features(), 'design' => stargatewars_fleet_motherships_design(), 'systems' => stargatewars_fleet_motherships_systems(), 'context' => $context];
}
