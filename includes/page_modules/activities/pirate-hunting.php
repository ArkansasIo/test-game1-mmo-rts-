<?php
declare(strict_types=1);

function stargatewars_activities_pirate_hunting_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/activities/pirate-hunting.php'; }
function stargatewars_activities_pirate_hunting_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/activities/pirate-hunting.php'; }
function stargatewars_activities_pirate_hunting_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/activities/pirate-hunting.php'; }
function stargatewars_activities_pirate_hunting_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/activities/pirate-hunting.php'; }
function stargatewars_activities_pirate_hunting_actions(): array { return stargatewars_activities_pirate_hunting_systems()['actions'] ?? []; }
function stargatewars_activities_pirate_hunting_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_activities_pirate_hunting_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_activities_pirate_hunting_preview(array $context = []): array {
    return ['route' => 'pirate-hunting', 'title' => 'Pirate Hunting', 'logic' => stargatewars_activities_pirate_hunting_logic(), 'features' => stargatewars_activities_pirate_hunting_features(), 'design' => stargatewars_activities_pirate_hunting_design(), 'systems' => stargatewars_activities_pirate_hunting_systems(), 'context' => $context];
}
