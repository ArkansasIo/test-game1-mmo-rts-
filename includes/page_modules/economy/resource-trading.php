<?php
declare(strict_types=1);

function stargatewars_economy_resource_trading_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/economy/resource-trading.php'; }
function stargatewars_economy_resource_trading_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/economy/resource-trading.php'; }
function stargatewars_economy_resource_trading_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/economy/resource-trading.php'; }
function stargatewars_economy_resource_trading_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/economy/resource-trading.php'; }
function stargatewars_economy_resource_trading_actions(): array { return stargatewars_economy_resource_trading_systems()['actions'] ?? []; }
function stargatewars_economy_resource_trading_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_economy_resource_trading_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_economy_resource_trading_preview(array $context = []): array {
    return ['route' => 'resource-trading', 'title' => 'Resource Trading', 'logic' => stargatewars_economy_resource_trading_logic(), 'features' => stargatewars_economy_resource_trading_features(), 'design' => stargatewars_economy_resource_trading_design(), 'systems' => stargatewars_economy_resource_trading_systems(), 'context' => $context];
}
