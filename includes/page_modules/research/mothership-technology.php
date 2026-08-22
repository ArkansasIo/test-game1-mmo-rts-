<?php
declare(strict_types=1);

function stargatewars_research_mothership_technology_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/research/mothership-technology.php'; }
function stargatewars_research_mothership_technology_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/research/mothership-technology.php'; }
function stargatewars_research_mothership_technology_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/research/mothership-technology.php'; }
function stargatewars_research_mothership_technology_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/research/mothership-technology.php'; }
function stargatewars_research_mothership_technology_actions(): array { return stargatewars_research_mothership_technology_systems()['actions'] ?? []; }
function stargatewars_research_mothership_technology_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_research_mothership_technology_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_research_mothership_technology_preview(array $context = []): array {
    return ['route' => 'mothership-technology', 'title' => 'Mothership Technology', 'logic' => stargatewars_research_mothership_technology_logic(), 'features' => stargatewars_research_mothership_technology_features(), 'design' => stargatewars_research_mothership_technology_design(), 'systems' => stargatewars_research_mothership_technology_systems(), 'context' => $context];
}
