<?php
declare(strict_types=1);

function stargatewars_empire_facilities_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/empire/facilities.php'; }
function stargatewars_empire_facilities_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/empire/facilities.php'; }
function stargatewars_empire_facilities_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/empire/facilities.php'; }
function stargatewars_empire_facilities_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/empire/facilities.php'; }
function stargatewars_empire_facilities_actions(): array { return stargatewars_empire_facilities_systems()['actions'] ?? []; }
function stargatewars_empire_facilities_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_empire_facilities_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_empire_facilities_preview(array $context = []): array {
    return ['route' => 'facilities', 'title' => 'Facilities', 'logic' => stargatewars_empire_facilities_logic(), 'features' => stargatewars_empire_facilities_features(), 'design' => stargatewars_empire_facilities_design(), 'systems' => stargatewars_empire_facilities_systems(), 'context' => $context];
}
