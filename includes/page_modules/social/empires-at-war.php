<?php
declare(strict_types=1);

function stargatewars_social_empires_at_war_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/social/empires-at-war.php'; }
function stargatewars_social_empires_at_war_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/social/empires-at-war.php'; }
function stargatewars_social_empires_at_war_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/social/empires-at-war.php'; }
function stargatewars_social_empires_at_war_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/social/empires-at-war.php'; }
function stargatewars_social_empires_at_war_actions(): array { return stargatewars_social_empires_at_war_systems()['actions'] ?? []; }
function stargatewars_social_empires_at_war_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_social_empires_at_war_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_social_empires_at_war_preview(array $context = []): array {
    return ['route' => 'empires-at-war', 'title' => 'Empires at War', 'logic' => stargatewars_social_empires_at_war_logic(), 'features' => stargatewars_social_empires_at_war_features(), 'design' => stargatewars_social_empires_at_war_design(), 'systems' => stargatewars_social_empires_at_war_systems(), 'context' => $context];
}
