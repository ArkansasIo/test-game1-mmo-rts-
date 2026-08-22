<?php
declare(strict_types=1);

function stargatewars_military_officers_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/military/officers.php'; }
function stargatewars_military_officers_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/military/officers.php'; }
function stargatewars_military_officers_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/military/officers.php'; }
function stargatewars_military_officers_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/military/officers.php'; }
function stargatewars_military_officers_actions(): array { return stargatewars_military_officers_systems()['actions'] ?? []; }
function stargatewars_military_officers_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_military_officers_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_military_officers_preview(array $context = []): array {
    return ['route' => 'officers', 'title' => 'Officers', 'logic' => stargatewars_military_officers_logic(), 'features' => stargatewars_military_officers_features(), 'design' => stargatewars_military_officers_design(), 'systems' => stargatewars_military_officers_systems(), 'context' => $context];
}
