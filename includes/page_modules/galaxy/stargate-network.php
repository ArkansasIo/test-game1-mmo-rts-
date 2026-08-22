<?php
declare(strict_types=1);

function stargatewars_galaxy_stargate_network_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/galaxy/stargate-network.php'; }
function stargatewars_galaxy_stargate_network_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/galaxy/stargate-network.php'; }
function stargatewars_galaxy_stargate_network_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/galaxy/stargate-network.php'; }
function stargatewars_galaxy_stargate_network_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/galaxy/stargate-network.php'; }
function stargatewars_galaxy_stargate_network_actions(): array { return stargatewars_galaxy_stargate_network_systems()['actions'] ?? []; }
function stargatewars_galaxy_stargate_network_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_galaxy_stargate_network_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_galaxy_stargate_network_preview(array $context = []): array {
    return ['route' => 'stargate-network', 'title' => 'Stargate Network', 'logic' => stargatewars_galaxy_stargate_network_logic(), 'features' => stargatewars_galaxy_stargate_network_features(), 'design' => stargatewars_galaxy_stargate_network_design(), 'systems' => stargatewars_galaxy_stargate_network_systems(), 'context' => $context];
}
