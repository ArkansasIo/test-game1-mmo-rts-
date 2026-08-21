<?php
declare(strict_types=1);

function stargatewars_account_ascension_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/account/ascension.php'; }
function stargatewars_account_ascension_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/account/ascension.php'; }
function stargatewars_account_ascension_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/account/ascension.php'; }
function stargatewars_account_ascension_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/account/ascension.php'; }
function stargatewars_account_ascension_actions(): array { return stargatewars_account_ascension_systems()['actions'] ?? []; }
function stargatewars_account_ascension_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_account_ascension_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_account_ascension_preview(array $context = []): array {
    return ['route' => 'ascension', 'title' => 'Ascension', 'logic' => stargatewars_account_ascension_logic(), 'features' => stargatewars_account_ascension_features(), 'design' => stargatewars_account_ascension_design(), 'systems' => stargatewars_account_ascension_systems(), 'context' => $context];
}

function stargatewars_account_ascension_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/account/ascension.php'; }
function stargatewars_account_ascension_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/account/ascension.php'; }
function stargatewars_account_ascension_state_transitions(): array { return stargatewars_account_ascension_logic()['state_transitions'] ?? []; }
