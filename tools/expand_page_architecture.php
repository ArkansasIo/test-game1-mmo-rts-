<?php
declare(strict_types=1);

/** Expand every registered page with detailed design, sub-design, feature, logic,
 * function-map, state-transition, accessibility, and module API metadata. */
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$layouts = [
    'dashboard' => ['primary'=>'Command overview','visual'=>'metric-grid','interaction'=>'turn settlement and live refresh'],
    'details' => ['primary'=>'Identity and status dossier','visual'=>'detail-table','interaction'=>'read-only inspection'],
    'economy' => ['primary'=>'Resource balance and vault','visual'=>'resource-grid','interaction'=>'validated deposit and withdrawal'],
    'breakdown' => ['primary'=>'Income formula and colony comparison','visual'=>'formula-panel','interaction'=>'read-only calculation'],
    'stats' => ['primary'=>'Military readiness and posture','visual'=>'power-metrics','interaction'=>'read and DefCon mutation'],
    'targets' => ['primary'=>'Known realm target board','visual'=>'sortable-target-table','interaction'=>'preview then validated operation'],
    'covert' => ['primary'=>'Covert mission console','visual'=>'mission-console','interaction'=>'agent allocation and detection preview'],
    'reports' => ['primary'=>'Classified report feed','visual'=>'report-list','interaction'=>'ownership-gated read state'],
    'inventory' => ['primary'=>'Weapon inventory and loadout','visual'=>'inventory-table','interaction'=>'purchase and durability inspection'],
    'market' => ['primary'=>'Escrowed market order book','visual'=>'order-book','interaction'=>'list, lock, settle'],
    'repair' => ['primary'=>'Durability repair queue','visual'=>'repair-queue','interaction'=>'estimate then queue repair'],
    'training' => ['primary'=>'Population training and readiness','visual'=>'queue-roster','interaction'=>'validate workforce then queue'],
    'upgrade' => ['primary'=>'Production upgrade tracks','visual'=>'upgrade-track','interaction'=>'prerequisite and queue validation'],
    'technology' => ['primary'=>'Technology research branches','visual'=>'tech-tree','interaction'=>'prerequisite and research queue'],
    'rankings' => ['primary'=>'Commander ranking ladder','visual'=>'ranking-table','interaction'=>'read snapshot and refresh'],
    'social' => ['primary'=>'Social and diplomacy workspace','visual'=>'relationship-panel','interaction'=>'role-gated social mutation'],
    'messages' => ['primary'=>'Secure commander messaging','visual'=>'inbox-thread','interaction'=>'recipient, blacklist, and read-state validation'],
    'planets' => ['primary'=>'Colony portfolio and life support','visual'=>'colony-grid','interaction'=>'ownership, habitability, and defense'],
    'ship' => ['primary'=>'Mothership hull and modules','visual'=>'ship-blueprint','interaction'=>'capacity, prerequisite, and queue validation'],
    'exploration' => ['primary'=>'Mothership expedition control','visual'=>'expedition-board','interaction'=>'readiness, distance, anomaly, reward'],
    'account' => ['primary'=>'Commander account controls','visual'=>'account-form','interaction'=>'eligibility and cooldown validation'],
    'progression' => ['primary'=>'Tier and level progression','visual'=>'progression-ladder','interaction'=>'requirement check then atomic transition'],
    'galaxies' => ['primary'=>'Galaxy visibility map','visual'=>'galaxy-map','interaction'=>'coordinate scope and discovery filtering'],
    'sectors' => ['primary'=>'Sector scan and risk board','visual'=>'sector-table','interaction'=>'server-side scan power and cooldown'],
    'solar-systems' => ['primary'=>'Solar system orbit map','visual'=>'orbit-map','interaction'=>'coordinate, gate, and fleet authority'],
    'universe-planets' => ['primary'=>'Universe planet catalogue','visual'=>'planet-catalogue','interaction'=>'inspection and colonization eligibility'],
    'moons' => ['primary'=>'Moon registry and gate status','visual'=>'orbital-table','interaction'=>'parent-colony ownership and gate upgrade'],
    'coordinates' => ['primary'=>'Validated coordinate navigation','visual'=>'coordinate-path','interaction'=>'tuple parsing and scoped result'],
];
$special = [
    'dashboard'=>['refresh_state','settle_turns','aggregate_resource_delta','render_event_feed'],
    'economy'=>['validate_vault_balance','calculate_net_settlement','apply_resource_transfer','write_economy_event'],
    'targets'=>['load_target_board','calculate_combat_preview','check_protection','resolve_deterministic_battle'],
    'covert'=>['load_agent_pool','calculate_detection','resolve_mission','persist_classified_report'],
    'reports'=>['load_owned_reports','classify_payload','mark_report_read','audit_report_access'],
    'training'=>['load_queue_capacity','validate_population','calculate_training_cost','enqueue_training'],
    'technology'=>['load_branch','check_prerequisites','calculate_research_cost','enqueue_research'],
    'planets'=>['load_colony_portfolio','calculate_life_support','validate_habitability','queue_colony_action'],
    'ship'=>['load_hull_and_modules','calculate_capacity','validate_module_slot','enqueue_mothership_upgrade'],
    'exploration'=>['validate_expedition_readiness','calculate_travel_time','resolve_anomaly','persist_discovery_reward'],
    'galaxies'=>['load_active_galaxies','apply_coordinate_scope','filter_discovered_sectors','summarize_ownership'],
    'sectors'=>['load_sector','calculate_scan_power','order_systems_by_strategy','classify_owner_signals'],
    'coordinates'=>['parse_coordinate_tuple','validate_hierarchy','apply_discovery_filter','build_navigation_identifiers'],
];
function slugFunction(string $value): string { return preg_replace('/[^a-z0-9]+/i', '_', strtolower($value)) ?: 'page'; }
function words(string $value): string { return ucwords(str_replace(['-','_'], ' ', $value)); }
function routePath(string $group, string $route): string { return $group . '/' . $route; }
function writePhpArray(string $path, array $value): void { file_put_contents($path, "<?php\nreturn " . var_export($value, true) . ";\n"); }

$counts = ['routes'=>0,'designs'=>0,'logic'=>0,'features'=>0,'subdesigns'=>0,'function_maps'=>0,'modules'=>0];
foreach ($registry as $group => $groupData) {
    foreach (($groupData['pages'] ?? []) as $route => $page) {
        $counts['routes']++;
        $layout = (string)($page['layout'] ?? 'details');
        $title = (string)($page['title'] ?? words($route));
        $actions = array_values(array_unique(array_map('strval', $page['actions'] ?? [])));
        $tables = array_values(array_unique(array_map('strval', $page['tables'] ?? [])));
        $base = $layouts[$layout] ?? ['primary'=>$title,'visual'=>'module-grid','interaction'=>'validated page interaction'];
        $groupSlug = slugFunction($group);
        $routeSlug = slugFunction($route);
        $prefix = "stargatewars_{$groupSlug}_{$routeSlug}";
        $existingDesign = require $root . "/config/page_design_specs/{$group}/{$route}.php";
        $existingLogic = require $root . "/config/page_logic/{$group}/{$route}.php";
        $existingFeatures = require $root . "/config/page_features/{$group}/{$route}.php";
        $subfunctions = $special[$layout] ?? ['load_page_state','validate_page_scope','calculate_page_metrics','render_page_result'];
        $actionFunctions = [];
        foreach ($actions as $action) {
            $actionFunctions[] = 'handle_' . slugFunction($action);
        }
        $functions = array_values(array_unique(array_merge(['load_state','validate_intent','preview_action','render_ready_state','render_empty_state','render_error_state'], $actionFunctions)));
        $states = array_values(array_unique(array_merge(['loading','ready','empty','error'], $actions ? ['submitting','success','cooldown','protected','insufficient-resource'] : [])));
        $design = array_merge($existingDesign, [
            'page_title'=>$title,
            'layout_family'=>$layout,
            'sub_design'=>[
                'primary_panel'=>$base['primary'],
                'visual_system'=>$base['visual'],
                'interaction_model'=>$base['interaction'],
                'sections'=>array_values(array_unique(array_merge($existingDesign['sections'] ?? [], ['status','controls','activity','technical-details']))),
                'components'=>array_values(array_unique(array_merge($existingDesign['components'] ?? [], ['state-banner','action-form','feedback-region','audit-trail']))),
                'hierarchy'=>['header','context-strip','primary-content','action-zone','feedback-zone','technical-details'],
            ],
            'responsive_breakpoints'=>['mobile'=>'single-column; controls stack; tables scroll','tablet'=>'two-column metrics; action panel below','desktop'=>'full information density with sidebar'],
            'interaction_patterns'=>['optimistic_ui'=>false,'server_authoritative'=>true,'csrf_required'=>true,'focus_after_feedback'=>'feedback-region'],
            'accessibility'=>['keyboard_navigation'=>true,'aria_live_feedback'=>true,'semantic_tables'=>in_array($base['visual'],['sortable-target-table','ranking-table','order-book','inventory-table','repair-queue','sector-table'],true),'reduced_motion_supported'=>true],
            'states'=>$states,
        ]);
        $logic = array_merge($existingLogic, [
            'page_title'=>$title,
            'layout_family'=>$layout,
            'functions'=>$functions,
            'sub_functions'=>$subfunctions,
            'state_transitions'=>[
                'loading'=>'load scoped state and render skeleton',
                'ready'=>'display authoritative state and enable permitted controls',
                'empty'=>'display an explicit no-records state without fabricating data',
                'submitting'=>'disable duplicate submission and show progress',
                'success'=>'refresh live state, append event, and announce result',
                'protected'=>'explain protection or ownership restriction without leaking data',
                'cooldown'=>'display remaining server cooldown and disable action',
                'insufficient-resource'=>'display missing resources and preserve state',
                'error'=>'display safe error feedback and retain navigation context',
            ],
            'server_authority'=>['client_submits_intent_only'=>true,'server_recalculates_costs'=>true,'server_validates_ownership'=>true,'server_commits_transaction'=>true],
            'data_flow'=>['reads'=>$tables,'writes'=>$tables,'actions'=>$actions,'event_sink'=>'game_events'],
        ]);
        $features = array_merge(['page_title'=>$title], is_array($existingFeatures) ? $existingFeatures : [], [
            'feature_matrix'=>[
                'core'=>['state snapshot','permission-aware rendering','feedback-state rendering'],
                'controls'=>$page['controls'] ?? [],
                'actions'=>$actions,
                'data_sources'=>$tables,
            ],
            'sub_features'=>array_values(array_unique(array_merge($existingFeatures['sub_features'] ?? [], $subfunctions))),
            'acceptance_criteria'=>['unauthorized input rejected','negative quantities rejected','empty state handled','success refreshes state','database mutation is transactional'],
        ]);
        writePhpArray($root . "/config/page_design_specs/{$group}/{$route}.php", $design);
        writePhpArray($root . "/config/page_logic/{$group}/{$route}.php", $logic);
        writePhpArray($root . "/config/page_features/{$group}/{$route}.php", $features);
        $subdesignDir = $root . "/config/page_subdesign/{$group}";
        $functionDir = $root . "/config/page_function_maps/{$group}";
        if (!is_dir($subdesignDir)) mkdir($subdesignDir, 0775, true);
        if (!is_dir($functionDir)) mkdir($functionDir, 0775, true);
        writePhpArray($subdesignDir . "/{$route}.php", $design['sub_design']);
        writePhpArray($functionDir . "/{$route}.php", ['route'=>$route,'title'=>$title,'functions'=>$functions,'sub_functions'=>$subfunctions,'actions'=>$actions,'state_transitions'=>$logic['state_transitions']]);
        $modulePath = $root . "/includes/page_modules/{$group}/{$route}.php";
        $module = file_get_contents($modulePath);
        if (!str_contains($module, "_function_map(): array")) {
            $module .= "\nfunction {$prefix}_sub_design(): array { return require '{$root}/config/page_subdesign/{$group}/{$route}.php'; }\n";
            $module .= "function {$prefix}_function_map(): array { return require '{$root}/config/page_function_maps/{$group}/{$route}.php'; }\n";
            $module .= "function {$prefix}_state_transitions(): array { return {$prefix}_logic()['state_transitions'] ?? []; }\n";
            file_put_contents($modulePath, $module);
            $counts['modules']++;
        }
        $counts['designs']++; $counts['logic']++; $counts['features']++; $counts['subdesigns']++; $counts['function_maps']++;
    }
}
echo json_encode($counts, JSON_PRETTY_PRINT) . PHP_EOL;
