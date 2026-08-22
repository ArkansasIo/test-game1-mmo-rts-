<?php
declare(strict_types=1);

function stargatewars_crafting_master_crafting_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/crafting/master-crafting.php'; }
function stargatewars_crafting_master_crafting_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/crafting/master-crafting.php'; }
function stargatewars_crafting_master_crafting_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/crafting/master-crafting.php'; }
function stargatewars_crafting_master_crafting_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/crafting/master-crafting.php'; }
function stargatewars_crafting_master_crafting_actions(): array { return stargatewars_crafting_master_crafting_systems()['actions'] ?? []; }
function stargatewars_crafting_master_crafting_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_crafting_master_crafting_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_crafting_master_crafting_preview(array $context = []): array {
    return ['route' => 'master-crafting', 'title' => 'Master Crafting', 'logic' => stargatewars_crafting_master_crafting_logic(), 'features' => stargatewars_crafting_master_crafting_features(), 'design' => stargatewars_crafting_master_crafting_design(), 'systems' => stargatewars_crafting_master_crafting_systems(), 'context' => $context];
}
