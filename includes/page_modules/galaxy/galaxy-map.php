<?php
declare(strict_types=1);

function stargatewars_galaxy_galaxy_map_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/galaxy/galaxy-map.php'; }
function stargatewars_galaxy_galaxy_map_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/galaxy/galaxy-map.php'; }
function stargatewars_galaxy_galaxy_map_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/galaxy/galaxy-map.php'; }
function stargatewars_galaxy_galaxy_map_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/galaxy/galaxy-map.php'; }
function stargatewars_galaxy_galaxy_map_actions(): array { return stargatewars_galaxy_galaxy_map_systems()['actions'] ?? []; }
function stargatewars_galaxy_galaxy_map_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_galaxy_galaxy_map_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_galaxy_galaxy_map_preview(array $context = []): array {
    return ['route' => 'galaxy-map', 'title' => 'Galaxy Map', 'logic' => stargatewars_galaxy_galaxy_map_logic(), 'features' => stargatewars_galaxy_galaxy_map_features(), 'design' => stargatewars_galaxy_galaxy_map_design(), 'systems' => stargatewars_galaxy_galaxy_map_systems(), 'context' => $context];
}
