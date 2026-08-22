<?php
declare(strict_types=1);

function stargatewars_premium_store_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/premium/store.php'; }
function stargatewars_premium_store_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/premium/store.php'; }
function stargatewars_premium_store_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/premium/store.php'; }
function stargatewars_premium_store_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/premium/store.php'; }
function stargatewars_premium_store_actions(): array { return stargatewars_premium_store_systems()['actions'] ?? []; }
function stargatewars_premium_store_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_premium_store_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_premium_store_preview(array $context = []): array {
    return ['route' => 'store', 'title' => 'Store', 'logic' => stargatewars_premium_store_logic(), 'features' => stargatewars_premium_store_features(), 'design' => stargatewars_premium_store_design(), 'systems' => stargatewars_premium_store_systems(), 'context' => $context];
}
