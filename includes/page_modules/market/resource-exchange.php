<?php
declare(strict_types=1);

function stargatewars_market_resource_exchange_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/market/resource-exchange.php'; }
function stargatewars_market_resource_exchange_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/market/resource-exchange.php'; }
function stargatewars_market_resource_exchange_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/market/resource-exchange.php'; }
function stargatewars_market_resource_exchange_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/market/resource-exchange.php'; }
function stargatewars_market_resource_exchange_actions(): array { return stargatewars_market_resource_exchange_systems()['actions'] ?? []; }
function stargatewars_market_resource_exchange_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_market_resource_exchange_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_market_resource_exchange_preview(array $context = []): array {
    return ['route' => 'resource-exchange', 'title' => 'Resource Exchange', 'logic' => stargatewars_market_resource_exchange_logic(), 'features' => stargatewars_market_resource_exchange_features(), 'design' => stargatewars_market_resource_exchange_design(), 'systems' => stargatewars_market_resource_exchange_systems(), 'context' => $context];
}

function stargatewars_market_resource_exchange_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/market/resource-exchange.php'; }
function stargatewars_market_resource_exchange_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/market/resource-exchange.php'; }
function stargatewars_market_resource_exchange_state_transitions(): array { return stargatewars_market_resource_exchange_logic()['state_transitions'] ?? []; }
