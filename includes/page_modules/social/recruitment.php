<?php
declare(strict_types=1);

function stargatewars_social_recruitment_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/social/recruitment.php'; }
function stargatewars_social_recruitment_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/social/recruitment.php'; }
function stargatewars_social_recruitment_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/social/recruitment.php'; }
function stargatewars_social_recruitment_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/social/recruitment.php'; }
function stargatewars_social_recruitment_actions(): array { return stargatewars_social_recruitment_systems()['actions'] ?? []; }
function stargatewars_social_recruitment_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_social_recruitment_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_social_recruitment_preview(array $context = []): array {
    return ['route' => 'recruitment', 'title' => 'Recruitment', 'logic' => stargatewars_social_recruitment_logic(), 'features' => stargatewars_social_recruitment_features(), 'design' => stargatewars_social_recruitment_design(), 'systems' => stargatewars_social_recruitment_systems(), 'context' => $context];
}
