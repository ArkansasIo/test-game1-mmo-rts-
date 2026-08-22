<?php
declare(strict_types=1);

function stargatewars_intelligence_intelligence_sabotage_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/intelligence/intelligence-sabotage.php'; }
function stargatewars_intelligence_intelligence_sabotage_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/intelligence/intelligence-sabotage.php'; }
function stargatewars_intelligence_intelligence_sabotage_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/intelligence/intelligence-sabotage.php'; }
function stargatewars_intelligence_intelligence_sabotage_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/intelligence/intelligence-sabotage.php'; }
function stargatewars_intelligence_intelligence_sabotage_actions(): array { return stargatewars_intelligence_intelligence_sabotage_systems()['actions'] ?? []; }
function stargatewars_intelligence_intelligence_sabotage_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_intelligence_intelligence_sabotage_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_intelligence_intelligence_sabotage_preview(array $context = []): array {
    return ['route' => 'intelligence-sabotage', 'title' => 'Sabotage', 'logic' => stargatewars_intelligence_intelligence_sabotage_logic(), 'features' => stargatewars_intelligence_intelligence_sabotage_features(), 'design' => stargatewars_intelligence_intelligence_sabotage_design(), 'systems' => stargatewars_intelligence_intelligence_sabotage_systems(), 'context' => $context];
}
