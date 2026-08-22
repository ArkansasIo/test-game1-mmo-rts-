<?php
declare(strict_types=1);

function stargatewars_construction_construction_queue_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/construction-queue.php'; }
function stargatewars_construction_construction_queue_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/construction-queue.php'; }
function stargatewars_construction_construction_queue_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/construction-queue.php'; }
function stargatewars_construction_construction_queue_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/construction-queue.php'; }
function stargatewars_construction_construction_queue_actions(): array { return stargatewars_construction_construction_queue_systems()['actions'] ?? []; }
function stargatewars_construction_construction_queue_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_construction_construction_queue_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_construction_queue_preview(array $context = []): array {
    return ['route' => 'construction-queue', 'title' => 'Construction Queue', 'logic' => stargatewars_construction_construction_queue_logic(), 'features' => stargatewars_construction_construction_queue_features(), 'design' => stargatewars_construction_construction_queue_design(), 'systems' => stargatewars_construction_construction_queue_systems(), 'context' => $context];
}
