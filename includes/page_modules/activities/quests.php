<?php
declare(strict_types=1);

function stargatewars_activities_quests_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/activities/quests.php'; }
function stargatewars_activities_quests_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/activities/quests.php'; }
function stargatewars_activities_quests_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/activities/quests.php'; }
function stargatewars_activities_quests_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/activities/quests.php'; }
function stargatewars_activities_quests_actions(): array { return stargatewars_activities_quests_systems()['actions'] ?? []; }
function stargatewars_activities_quests_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_activities_quests_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_activities_quests_preview(array $context = []): array {
    return ['route' => 'quests', 'title' => 'Quests', 'logic' => stargatewars_activities_quests_logic(), 'features' => stargatewars_activities_quests_features(), 'design' => stargatewars_activities_quests_design(), 'systems' => stargatewars_activities_quests_systems(), 'context' => $context];
}
