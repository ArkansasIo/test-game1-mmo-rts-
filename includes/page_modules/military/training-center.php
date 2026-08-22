<?php
declare(strict_types=1);

function stargatewars_military_training_center_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/military/training-center.php'; }
function stargatewars_military_training_center_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/military/training-center.php'; }
function stargatewars_military_training_center_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/military/training-center.php'; }
function stargatewars_military_training_center_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/military/training-center.php'; }
function stargatewars_military_training_center_actions(): array { return stargatewars_military_training_center_systems()['actions'] ?? []; }
function stargatewars_military_training_center_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_military_training_center_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_military_training_center_preview(array $context = []): array {
    return ['route' => 'training-center', 'title' => 'Training Center', 'logic' => stargatewars_military_training_center_logic(), 'features' => stargatewars_military_training_center_features(), 'design' => stargatewars_military_training_center_design(), 'systems' => stargatewars_military_training_center_systems(), 'context' => $context];
}
