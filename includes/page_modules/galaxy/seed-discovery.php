<?php
declare(strict_types=1);

function stargatewars_galaxy_seed_discovery_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/galaxy/seed-discovery.php'; }
function stargatewars_galaxy_seed_discovery_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/galaxy/seed-discovery.php'; }
function stargatewars_galaxy_seed_discovery_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/galaxy/seed-discovery.php'; }
function stargatewars_galaxy_seed_discovery_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/galaxy/seed-discovery.php'; }
function stargatewars_galaxy_seed_discovery_actions(): array { return stargatewars_galaxy_seed_discovery_systems()['actions'] ?? []; }
function stargatewars_galaxy_seed_discovery_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_galaxy_seed_discovery_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_galaxy_seed_discovery_preview(array $context = []): array {
    return ['route' => 'seed-discovery', 'title' => 'Seed Discovery', 'logic' => stargatewars_galaxy_seed_discovery_logic(), 'features' => stargatewars_galaxy_seed_discovery_features(), 'design' => stargatewars_galaxy_seed_discovery_design(), 'systems' => stargatewars_galaxy_seed_discovery_systems(), 'context' => $context];
}
