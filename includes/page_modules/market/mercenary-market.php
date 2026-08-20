<?php
declare(strict_types=1);

function stargatewars_market_mercenary_market_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/market/mercenary-market.php'; }
function stargatewars_market_mercenary_market_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/market/mercenary-market.php'; }
function stargatewars_market_mercenary_market_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/market/mercenary-market.php'; }
function stargatewars_market_mercenary_market_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/market/mercenary-market.php'; }
function stargatewars_market_mercenary_market_actions(): array { return stargatewars_market_mercenary_market_systems()['actions'] ?? []; }
function stargatewars_market_mercenary_market_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_market_mercenary_market_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_market_mercenary_market_preview(array $context = []): array {
    return ['route' => 'mercenary-market', 'title' => 'Mercenary Market', 'logic' => stargatewars_market_mercenary_market_logic(), 'features' => stargatewars_market_mercenary_market_features(), 'design' => stargatewars_market_mercenary_market_design(), 'systems' => stargatewars_market_mercenary_market_systems(), 'context' => $context];
}
