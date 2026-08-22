<?php
declare(strict_types=1);

function stargatewars_rankings_economy_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/rankings/economy.php'; }
function stargatewars_rankings_economy_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/rankings/economy.php'; }
function stargatewars_rankings_economy_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/rankings/economy.php'; }
function stargatewars_rankings_economy_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/rankings/economy.php'; }
function stargatewars_rankings_economy_actions(): array { return stargatewars_rankings_economy_systems()['actions'] ?? []; }
function stargatewars_rankings_economy_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_rankings_economy_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_rankings_economy_preview(array $context = []): array {
    return ['route' => 'economy', 'title' => 'Economy', 'logic' => stargatewars_rankings_economy_logic(), 'features' => stargatewars_rankings_economy_features(), 'design' => stargatewars_rankings_economy_design(), 'systems' => stargatewars_rankings_economy_systems(), 'context' => $context];
}
