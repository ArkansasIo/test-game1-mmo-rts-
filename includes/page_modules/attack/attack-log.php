<?php
declare(strict_types=1);

function stargatewars_attack_attack_log_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/attack/attack-log.php'; }
function stargatewars_attack_attack_log_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/attack/attack-log.php'; }
function stargatewars_attack_attack_log_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/attack/attack-log.php'; }
function stargatewars_attack_attack_log_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/attack/attack-log.php'; }
function stargatewars_attack_attack_log_actions(): array { return stargatewars_attack_attack_log_systems()['actions'] ?? []; }
function stargatewars_attack_attack_log_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_attack_attack_log_actions(), true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    if (in_array($action, ['combat','combat:raid','covert:recon','covert:spy','covert:sabotage'], true) && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid target is required.'; }
    if (in_array($action, ['deposit','withdraw','train','upgrade_up','technology','weapon_buy','weapon_repair'], true) && (int)($input['amount'] ?? $input['quantity'] ?? 0) < 0) { $errors['amount'] = 'The requested amount must not be negative.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_attack_attack_log_preview(array $context = []): array {
    return ['route' => 'attack-log', 'title' => 'Attack Log & Reports', 'logic' => stargatewars_attack_attack_log_logic(), 'features' => stargatewars_attack_attack_log_features(), 'design' => stargatewars_attack_attack_log_design(), 'systems' => stargatewars_attack_attack_log_systems(), 'context' => $context];
}

function stargatewars_attack_attack_log_sub_design(): array { return require '/home/ubuntu/stargatewars/config/page_subdesign/attack/attack-log.php'; }
function stargatewars_attack_attack_log_function_map(): array { return require '/home/ubuntu/stargatewars/config/page_function_maps/attack/attack-log.php'; }
function stargatewars_attack_attack_log_state_transitions(): array { return stargatewars_attack_attack_log_logic()['state_transitions'] ?? []; }
