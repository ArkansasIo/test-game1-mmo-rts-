<?php
declare(strict_types=1);

function stargatewars_attack_spy_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/attack/spy.php'; }
function stargatewars_attack_spy_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/attack/spy.php'; }
function stargatewars_attack_spy_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/attack/spy.php'; }
function stargatewars_attack_spy_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/attack/spy.php'; }
function stargatewars_attack_spy_actions(): array { return stargatewars_attack_spy_systems()['actions'] ?? []; }
function stargatewars_attack_spy_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_attack_spy_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_attack_spy_preview(array $context = []): array {
    return ['route' => 'spy', 'title' => 'Spy Operations', 'logic' => stargatewars_attack_spy_logic(), 'features' => stargatewars_attack_spy_features(), 'design' => stargatewars_attack_spy_design(), 'systems' => stargatewars_attack_spy_systems(), 'context' => $context];
}
