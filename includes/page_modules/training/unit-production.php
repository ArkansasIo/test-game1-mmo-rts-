<?php
declare(strict_types=1);

function stargatewars_training_unit_production_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/training/unit-production.php'; }
function stargatewars_training_unit_production_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/training/unit-production.php'; }
function stargatewars_training_unit_production_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/training/unit-production.php'; }
function stargatewars_training_unit_production_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/training/unit-production.php'; }
function stargatewars_training_unit_production_actions(): array { return stargatewars_training_unit_production_systems()['actions'] ?? []; }
function stargatewars_training_unit_production_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_training_unit_production_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_training_unit_production_preview(array $context = []): array {
    return ['route' => 'unit-production', 'title' => 'Unit Production', 'logic' => stargatewars_training_unit_production_logic(), 'features' => stargatewars_training_unit_production_features(), 'design' => stargatewars_training_unit_production_design(), 'systems' => stargatewars_training_unit_production_systems(), 'context' => $context];
}
