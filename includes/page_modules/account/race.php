<?php
declare(strict_types=1);

function stargatewars_account_race_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/account/race.php'; }
function stargatewars_account_race_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/account/race.php'; }
function stargatewars_account_race_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/account/race.php'; }
function stargatewars_account_race_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/account/race.php'; }
function stargatewars_account_race_actions(): array { return stargatewars_account_race_systems()['actions'] ?? []; }
function stargatewars_account_race_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_account_race_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_account_race_preview(array $context = []): array {
    return ['route' => 'race', 'title' => 'Race Selection', 'logic' => stargatewars_account_race_logic(), 'features' => stargatewars_account_race_features(), 'design' => stargatewars_account_race_design(), 'systems' => stargatewars_account_race_systems(), 'context' => $context];
}
