<?php
declare(strict_types=1);

function stargatewars_crafting_workshop_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/crafting/workshop.php'; }
function stargatewars_crafting_workshop_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/crafting/workshop.php'; }
function stargatewars_crafting_workshop_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/crafting/workshop.php'; }
function stargatewars_crafting_workshop_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/crafting/workshop.php'; }
function stargatewars_crafting_workshop_actions(): array { return stargatewars_crafting_workshop_systems()['actions'] ?? []; }
function stargatewars_crafting_workshop_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_crafting_workshop_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_crafting_workshop_preview(array $context = []): array {
    return ['route' => 'workshop', 'title' => 'Workshop', 'logic' => stargatewars_crafting_workshop_logic(), 'features' => stargatewars_crafting_workshop_features(), 'design' => stargatewars_crafting_workshop_design(), 'systems' => stargatewars_crafting_workshop_systems(), 'context' => $context];
}
