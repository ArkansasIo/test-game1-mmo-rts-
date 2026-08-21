<?php
declare(strict_types=1);

function stargatewars_command_center_account_info_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/command-center/account-info.php'; }
function stargatewars_command_center_account_info_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/command-center/account-info.php'; }
function stargatewars_command_center_account_info_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/command-center/account-info.php'; }
function stargatewars_command_center_account_info_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/command-center/account-info.php'; }
function stargatewars_command_center_account_info_actions(): array { return stargatewars_command_center_account_info_systems()['actions'] ?? []; }
function stargatewars_command_center_account_info_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_command_center_account_info_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_command_center_account_info_preview(array $context = []): array {
    return ['route' => 'account-info', 'title' => 'Account Information', 'logic' => stargatewars_command_center_account_info_logic(), 'features' => stargatewars_command_center_account_info_features(), 'design' => stargatewars_command_center_account_info_design(), 'systems' => stargatewars_command_center_account_info_systems(), 'context' => $context];
}

function stargatewars_command_center_account_info_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/command-center/account-info.php'; }
function stargatewars_command_center_account_info_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/command-center/account-info.php'; }
function stargatewars_command_center_account_info_state_transitions(): array { return stargatewars_command_center_account_info_logic()['state_transitions'] ?? []; }
