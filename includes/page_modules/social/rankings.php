<?php
declare(strict_types=1);

function stargatewars_social_rankings_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/social/rankings.php'; }
function stargatewars_social_rankings_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/social/rankings.php'; }
function stargatewars_social_rankings_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/social/rankings.php'; }
function stargatewars_social_rankings_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/social/rankings.php'; }
function stargatewars_social_rankings_actions(): array { return stargatewars_social_rankings_systems()['actions'] ?? []; }
function stargatewars_social_rankings_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_social_rankings_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_social_rankings_preview(array $context = []): array {
    return ['route' => 'rankings', 'title' => 'Rankings', 'logic' => stargatewars_social_rankings_logic(), 'features' => stargatewars_social_rankings_features(), 'design' => stargatewars_social_rankings_design(), 'systems' => stargatewars_social_rankings_systems(), 'context' => $context];
}

function stargatewars_social_rankings_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/social/rankings.php'; }
function stargatewars_social_rankings_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/social/rankings.php'; }
function stargatewars_social_rankings_state_transitions(): array { return stargatewars_social_rankings_logic()['state_transitions'] ?? []; }
