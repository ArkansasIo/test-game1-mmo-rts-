<?php
declare(strict_types=1);

function stargatewars_crafting_augmentations_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/crafting/augmentations.php'; }
function stargatewars_crafting_augmentations_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/crafting/augmentations.php'; }
function stargatewars_crafting_augmentations_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/crafting/augmentations.php'; }
function stargatewars_crafting_augmentations_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/crafting/augmentations.php'; }
function stargatewars_crafting_augmentations_actions(): array { return stargatewars_crafting_augmentations_systems()['actions'] ?? []; }
function stargatewars_crafting_augmentations_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_crafting_augmentations_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_crafting_augmentations_preview(array $context = []): array {
    return ['route' => 'augmentations', 'title' => 'Augmentations', 'logic' => stargatewars_crafting_augmentations_logic(), 'features' => stargatewars_crafting_augmentations_features(), 'design' => stargatewars_crafting_augmentations_design(), 'systems' => stargatewars_crafting_augmentations_systems(), 'context' => $context];
}
