<?php
declare(strict_types=1);

function stargatewars_universe_sectors_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/universe/sectors.php'; }
function stargatewars_universe_sectors_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/universe/sectors.php'; }
function stargatewars_universe_sectors_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/universe/sectors.php'; }
function stargatewars_universe_sectors_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/universe/sectors.php'; }
function stargatewars_universe_sectors_actions(): array { return stargatewars_universe_sectors_systems()['actions'] ?? []; }
function stargatewars_universe_sectors_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_universe_sectors_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_universe_sectors_preview(array $context = []): array {
    return ['route' => 'sectors', 'title' => 'Sector Map', 'logic' => stargatewars_universe_sectors_logic(), 'features' => stargatewars_universe_sectors_features(), 'design' => stargatewars_universe_sectors_design(), 'systems' => stargatewars_universe_sectors_systems(), 'context' => $context];
}

function stargatewars_universe_sectors_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/universe/sectors.php'; }
function stargatewars_universe_sectors_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/universe/sectors.php'; }
function stargatewars_universe_sectors_state_transitions(): array { return stargatewars_universe_sectors_logic()['state_transitions'] ?? []; }
