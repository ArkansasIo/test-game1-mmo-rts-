<?php
declare(strict_types=1);

function stargatewars_overview_overview_dashboard_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/overview/overview-dashboard.php'; }
function stargatewars_overview_overview_dashboard_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/overview/overview-dashboard.php'; }
function stargatewars_overview_overview_dashboard_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/overview/overview-dashboard.php'; }
function stargatewars_overview_overview_dashboard_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/overview/overview-dashboard.php'; }
function stargatewars_overview_overview_dashboard_actions(): array { return stargatewars_overview_overview_dashboard_systems()['actions'] ?? []; }
function stargatewars_overview_overview_dashboard_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_overview_overview_dashboard_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_overview_overview_dashboard_preview(array $context = []): array {
    return ['route' => 'overview-dashboard', 'title' => 'Dashboard', 'logic' => stargatewars_overview_overview_dashboard_logic(), 'features' => stargatewars_overview_overview_dashboard_features(), 'design' => stargatewars_overview_overview_dashboard_design(), 'systems' => stargatewars_overview_overview_dashboard_systems(), 'context' => $context];
}
