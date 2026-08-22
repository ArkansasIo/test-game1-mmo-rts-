<?php
declare(strict_types=1);

function stargatewars_prestige_reputation_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/prestige/reputation.php'; }
function stargatewars_prestige_reputation_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/prestige/reputation.php'; }
function stargatewars_prestige_reputation_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/prestige/reputation.php'; }
function stargatewars_prestige_reputation_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/prestige/reputation.php'; }
function stargatewars_prestige_reputation_actions(): array { return stargatewars_prestige_reputation_systems()['actions'] ?? []; }
function stargatewars_prestige_reputation_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_prestige_reputation_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_prestige_reputation_preview(array $context = []): array {
    return ['route' => 'reputation', 'title' => 'Reputation', 'logic' => stargatewars_prestige_reputation_logic(), 'features' => stargatewars_prestige_reputation_features(), 'design' => stargatewars_prestige_reputation_design(), 'systems' => stargatewars_prestige_reputation_systems(), 'context' => $context];
}
