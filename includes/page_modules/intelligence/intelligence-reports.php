<?php
declare(strict_types=1);

function stargatewars_intelligence_intelligence_reports_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/intelligence/intelligence-reports.php'; }
function stargatewars_intelligence_intelligence_reports_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/intelligence/intelligence-reports.php'; }
function stargatewars_intelligence_intelligence_reports_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/intelligence/intelligence-reports.php'; }
function stargatewars_intelligence_intelligence_reports_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/intelligence/intelligence-reports.php'; }
function stargatewars_intelligence_intelligence_reports_actions(): array { return stargatewars_intelligence_intelligence_reports_systems()['actions'] ?? []; }
function stargatewars_intelligence_intelligence_reports_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_intelligence_intelligence_reports_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_intelligence_intelligence_reports_preview(array $context = []): array {
    return ['route' => 'intelligence-reports', 'title' => 'Intelligence Reports', 'logic' => stargatewars_intelligence_intelligence_reports_logic(), 'features' => stargatewars_intelligence_intelligence_reports_features(), 'design' => stargatewars_intelligence_intelligence_reports_design(), 'systems' => stargatewars_intelligence_intelligence_reports_systems(), 'context' => $context];
}
