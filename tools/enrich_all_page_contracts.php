<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$templates = [
    'intelligence' => [
        'formula' => 'detection = defender counter-intelligence − attacker agents − covert technology',
        'actions' => ['covert:recon', 'covert:spy', 'covert:sabotage', 'refresh_page'],
        'tables' => ['players', 'target_realms', 'player_resources', 'covert_missions', 'intelligence_reports', 'espionage_events', 'game_events'],
        'features' => ['target board', 'agent allocation', 'detection meter', 'reconnaissance reports', 'spy mission reports', 'bounded sabotage', 'classified report access', 'cooldown visibility'],
        'functions' => ['select target', 'allocate agents', 'run reconnaissance', 'run spy mission', 'run sabotage', 'review classified reports'],
    ],
    'alliance' => [
        'formula' => 'alliance capacity = command level × alliance technology × government modifier',
        'actions' => ['alliance_create', 'alliance_join', 'diplomacy_propose', 'refresh_page'],
        'tables' => ['alliances', 'alliance_members', 'alliance_projects', 'game_events'],
        'features' => ['membership roster', 'role permissions', 'shared projects', 'diplomacy map', 'war coordination', 'alliance intelligence'],
        'functions' => ['inspect alliance', 'manage membership', 'propose diplomacy', 'coordinate war', 'review projects'],
    ],
    'premium' => [
        'formula' => 'premium state = wallet balance + entitlement state + bounded service effects',
        'actions' => ['premium_purchase', 'premium_claim', 'premium_activate', 'refresh_page'],
        'tables' => ['premium_catalog', 'player_premium', 'premium_transactions', 'game_events'],
        'features' => ['wallet telemetry', 'season pass', 'officer effects', 'service credits', 'daily reward', 'transaction audit'],
        'functions' => ['inspect wallet', 'claim reward', 'activate entitlement', 'review transactions'],
    ],
];
$default = [
    'formula' => 'server-authoritative subsystem state = validated inputs + scoped records + pending operations',
    'actions' => ['inspect_page', 'refresh_page'],
    'tables' => ['players', 'player_resources', 'game_events'],
    'features' => ['summary metrics', 'status badges', 'related-page navigation', 'empty-state guidance'],
    'functions' => ['open overview', 'review status', 'inspect records', 'review alerts'],
];
function put_php(string $path, array $data): void {
    file_put_contents($path, "<?php\ndeclare(strict_types=1);\nreturn " . var_export($data, true) . ";\n");
}
foreach ($registry as $group => $block) {
    foreach (($block['pages'] ?? []) as $route => $page) {
        $template = $templates[$group] ?? $default;
        $title = (string)($page['title'] ?? ucwords(str_replace('-', ' ', $route)));
        $actions = $template['actions'];
        $tables = $template['tables'];
        $features = $template['features'];
        $functions = $template['functions'];
        $readOnly = $actions === ['inspect_page', 'refresh_page'];
        $definition = [
            'route' => $route,
            'group' => $group,
            'group_label' => $block['label'] ?? ucwords(str_replace('-', ' ', $group)),
            'title' => $title,
            'layout' => $page['layout'] ?? 'dashboard',
            'purpose' => $title . ' subsystem console with server-authoritative state, controls, dependencies, and feedback.',
            'mechanic' => $template['formula'],
            'controls' => $functions,
            'actions' => $actions,
            'tables' => $tables,
            'details' => ['current state' => 'server-calculated telemetry', 'available controls' => 'permission-aware operations', 'dependencies' => 'validated prerequisites and cooldowns', 'audit' => 'transactional event history'],
            'logic' => ['purpose' => $title . ' operations', 'workflow' => ['load scoped state', 'validate authenticated intent', 'lock required records', 'resolve authoritative mechanic', 'write audit event', 'return feedback'], 'validation' => ['authenticated commander', 'CSRF token', 'RBAC policy', 'ownership scope', 'cooldown validation', 'transaction boundary'], 'calculations' => [$template['formula']], 'mutations' => $readOnly ? [] : $tables],
            'features' => $features,
            'sub_features' => ['loading and refresh state', 'permission-aware controls', 'related-page navigation', 'filter and sort state', 'empty-state explanation', 'audit and feedback detail'],
            'design' => ['template' => $group === 'intelligence' ? 'covert-operations' : 'specification-dashboard', 'sections' => ['overview', 'controls', 'features', 'system-design', 'information', 'feedback-states'], 'components' => ['metric-strip', 'operation-controls', 'status-badge', 'data-table', 'feedback-panel'], 'responsive' => 'horizontal dashboard with stacked mobile layout'],
            'systems' => ['services' => [$group === 'intelligence' ? 'EspionageScanningService' : 'PageService'], 'reads' => $tables, 'writes' => $readOnly ? [] : $tables, 'actions' => $actions, 'permissions' => ['authenticated commander', 'CSRF', 'RBAC', 'ownership scope', 'cooldown validation']],
            'feedback_states' => ['loading', 'ready', 'empty', 'protected', 'cooldown', 'insufficient-resource', 'success', 'error'],
            'contract_files' => ['logic' => "config/page_logic/$group/$route.php", 'features' => "config/page_features/$group/$route.php", 'design' => "config/page_design_specs/$group/$route.php", 'systems' => "config/page_systems/$group/$route.php", 'module' => "includes/page_modules/$group/$route.php"],
        ];
        put_php($root . "/config/page_definitions/$group/$route.php", $definition);
        put_php($root . "/config/page_logic/$group/$route.php", $definition['logic']);
        put_php($root . "/config/page_features/$group/$route.php", ['title' => $title, 'features' => $features, 'sub_features' => $definition['sub_features']]);
        put_php($root . "/config/page_design_specs/$group/$route.php", $definition['design']);
        put_php($root . "/config/page_systems/$group/$route.php", $definition['systems']);
    }
}
echo "Enriched all registered page contracts\n";
