<?php
declare(strict_types=1);

function stargatewars_empire_colonies_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/empire/colonies.php'; }
function stargatewars_empire_colonies_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/empire/colonies.php'; }
function stargatewars_empire_colonies_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/empire/colonies.php'; }
function stargatewars_empire_colonies_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/empire/colonies.php'; }
function stargatewars_empire_colonies_actions(): array { return stargatewars_empire_colonies_systems()['actions'] ?? []; }
function stargatewars_empire_colonies_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_empire_colonies_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_empire_colonies_preview(array $context = []): array {
    return ['route' => 'colonies', 'title' => 'Colonies', 'logic' => stargatewars_empire_colonies_logic(), 'features' => stargatewars_empire_colonies_features(), 'design' => stargatewars_empire_colonies_design(), 'systems' => stargatewars_empire_colonies_systems(), 'context' => $context];
}
