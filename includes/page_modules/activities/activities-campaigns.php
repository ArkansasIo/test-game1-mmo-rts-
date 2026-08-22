<?php
declare(strict_types=1);

function stargatewars_activities_activities_campaigns_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/activities/activities-campaigns.php'; }
function stargatewars_activities_activities_campaigns_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/activities/activities-campaigns.php'; }
function stargatewars_activities_activities_campaigns_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/activities/activities-campaigns.php'; }
function stargatewars_activities_activities_campaigns_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/activities/activities-campaigns.php'; }
function stargatewars_activities_activities_campaigns_actions(): array { return stargatewars_activities_activities_campaigns_systems()['actions'] ?? []; }
function stargatewars_activities_activities_campaigns_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_activities_activities_campaigns_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_activities_activities_campaigns_preview(array $context = []): array {
    return ['route' => 'activities-campaigns', 'title' => 'Campaigns', 'logic' => stargatewars_activities_activities_campaigns_logic(), 'features' => stargatewars_activities_activities_campaigns_features(), 'design' => stargatewars_activities_activities_campaigns_design(), 'systems' => stargatewars_activities_activities_campaigns_systems(), 'context' => $context];
}
