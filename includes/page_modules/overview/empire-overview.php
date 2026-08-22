<?php
declare(strict_types=1);

function stargatewars_overview_empire_overview_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/overview/empire-overview.php'; }
function stargatewars_overview_empire_overview_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/overview/empire-overview.php'; }
function stargatewars_overview_empire_overview_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/overview/empire-overview.php'; }
function stargatewars_overview_empire_overview_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/overview/empire-overview.php'; }
function stargatewars_overview_empire_overview_actions(): array { return stargatewars_overview_empire_overview_systems()['actions'] ?? []; }
function stargatewars_overview_empire_overview_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_overview_empire_overview_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_overview_empire_overview_preview(array $context = []): array {
    return ['route' => 'empire-overview', 'title' => 'Empire Overview', 'logic' => stargatewars_overview_empire_overview_logic(), 'features' => stargatewars_overview_empire_overview_features(), 'design' => stargatewars_overview_empire_overview_design(), 'systems' => stargatewars_overview_empire_overview_systems(), 'context' => $context];
}
