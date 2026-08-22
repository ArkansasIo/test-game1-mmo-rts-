<?php
declare(strict_types=1);

function stargatewars_alliance_alliance_stargates_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/alliance/alliance-stargates.php'; }
function stargatewars_alliance_alliance_stargates_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/alliance/alliance-stargates.php'; }
function stargatewars_alliance_alliance_stargates_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/alliance/alliance-stargates.php'; }
function stargatewars_alliance_alliance_stargates_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/alliance/alliance-stargates.php'; }
function stargatewars_alliance_alliance_stargates_actions(): array { return stargatewars_alliance_alliance_stargates_systems()['actions'] ?? []; }
function stargatewars_alliance_alliance_stargates_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_alliance_alliance_stargates_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_alliance_alliance_stargates_preview(array $context = []): array {
    return ['route' => 'alliance-stargates', 'title' => 'Alliance Stargates', 'logic' => stargatewars_alliance_alliance_stargates_logic(), 'features' => stargatewars_alliance_alliance_stargates_features(), 'design' => stargatewars_alliance_alliance_stargates_design(), 'systems' => stargatewars_alliance_alliance_stargates_systems(), 'context' => $context];
}
