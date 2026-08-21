<?php
declare(strict_types=1);

function stargatewars_command_center_income_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/command-center/income.php'; }
function stargatewars_command_center_income_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/command-center/income.php'; }
function stargatewars_command_center_income_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/command-center/income.php'; }
function stargatewars_command_center_income_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/command-center/income.php'; }
function stargatewars_command_center_income_actions(): array { return stargatewars_command_center_income_systems()['actions'] ?? []; }
function stargatewars_command_center_income_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_command_center_income_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_command_center_income_preview(array $context = []): array {
    return ['route' => 'income', 'title' => 'Income Breakdown', 'logic' => stargatewars_command_center_income_logic(), 'features' => stargatewars_command_center_income_features(), 'design' => stargatewars_command_center_income_design(), 'systems' => stargatewars_command_center_income_systems(), 'context' => $context];
}

function stargatewars_command_center_income_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/command-center/income.php'; }
function stargatewars_command_center_income_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/command-center/income.php'; }
function stargatewars_command_center_income_state_transitions(): array { return stargatewars_command_center_income_logic()['state_transitions'] ?? []; }
