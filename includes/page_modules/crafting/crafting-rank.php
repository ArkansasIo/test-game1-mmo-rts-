<?php
declare(strict_types=1);

function stargatewars_crafting_crafting_rank_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/crafting/crafting-rank.php'; }
function stargatewars_crafting_crafting_rank_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/crafting/crafting-rank.php'; }
function stargatewars_crafting_crafting_rank_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/crafting/crafting-rank.php'; }
function stargatewars_crafting_crafting_rank_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/crafting/crafting-rank.php'; }
function stargatewars_crafting_crafting_rank_actions(): array { return stargatewars_crafting_crafting_rank_systems()['actions'] ?? []; }
function stargatewars_crafting_crafting_rank_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_crafting_crafting_rank_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_crafting_crafting_rank_preview(array $context = []): array {
    return ['route' => 'crafting-rank', 'title' => 'Crafting Rank', 'logic' => stargatewars_crafting_crafting_rank_logic(), 'features' => stargatewars_crafting_crafting_rank_features(), 'design' => stargatewars_crafting_crafting_rank_design(), 'systems' => stargatewars_crafting_crafting_rank_systems(), 'context' => $context];
}
