<?php
declare(strict_types=1);

function stargatewars_crafting_dismantling_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/crafting/dismantling.php'; }
function stargatewars_crafting_dismantling_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/crafting/dismantling.php'; }
function stargatewars_crafting_dismantling_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/crafting/dismantling.php'; }
function stargatewars_crafting_dismantling_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/crafting/dismantling.php'; }
function stargatewars_crafting_dismantling_actions(): array { return stargatewars_crafting_dismantling_systems()['actions'] ?? []; }
function stargatewars_crafting_dismantling_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_crafting_dismantling_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_crafting_dismantling_preview(array $context = []): array {
    return ['route' => 'dismantling', 'title' => 'Dismantling', 'logic' => stargatewars_crafting_dismantling_logic(), 'features' => stargatewars_crafting_dismantling_features(), 'design' => stargatewars_crafting_dismantling_design(), 'systems' => stargatewars_crafting_dismantling_systems(), 'context' => $context];
}
