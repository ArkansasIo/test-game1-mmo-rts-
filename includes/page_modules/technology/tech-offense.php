<?php
declare(strict_types=1);

function stargatewars_technology_tech_offense_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/technology/tech-offense.php'; }
function stargatewars_technology_tech_offense_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/technology/tech-offense.php'; }
function stargatewars_technology_tech_offense_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/technology/tech-offense.php'; }
function stargatewars_technology_tech_offense_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/technology/tech-offense.php'; }
function stargatewars_technology_tech_offense_actions(): array { return stargatewars_technology_tech_offense_systems()['actions'] ?? []; }
function stargatewars_technology_tech_offense_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_technology_tech_offense_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_technology_tech_offense_preview(array $context = []): array {
    return ['route' => 'tech-offense', 'title' => 'Offense Technology', 'logic' => stargatewars_technology_tech_offense_logic(), 'features' => stargatewars_technology_tech_offense_features(), 'design' => stargatewars_technology_tech_offense_design(), 'systems' => stargatewars_technology_tech_offense_systems(), 'context' => $context];
}
