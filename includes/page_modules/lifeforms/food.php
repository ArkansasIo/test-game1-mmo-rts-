<?php
declare(strict_types=1);

function stargatewars_lifeforms_food_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/lifeforms/food.php'; }
function stargatewars_lifeforms_food_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/lifeforms/food.php'; }
function stargatewars_lifeforms_food_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/lifeforms/food.php'; }
function stargatewars_lifeforms_food_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/lifeforms/food.php'; }
function stargatewars_lifeforms_food_actions(): array { return stargatewars_lifeforms_food_systems()['actions'] ?? []; }
function stargatewars_lifeforms_food_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_lifeforms_food_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_lifeforms_food_preview(array $context = []): array {
    return ['route' => 'food', 'title' => 'Food', 'logic' => stargatewars_lifeforms_food_logic(), 'features' => stargatewars_lifeforms_food_features(), 'design' => stargatewars_lifeforms_food_design(), 'systems' => stargatewars_lifeforms_food_systems(), 'context' => $context];
}
