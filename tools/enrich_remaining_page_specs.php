<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$specs = require $root . '/config/detailed_page_specs.php';
$registry = require $root . '/config/page_registry.php';
$specialized = ['dashboard','account-info','resources','income','military-stats','sabotage','attack-log','weapons','weapon-market','tech-defense','repair','units','training','miners','super-units','unit-production','technology','tech-offense','tech-covert','tech-anti-covert','spy-log','enemy-intelligence','race','vacation','ascension','galaxies','sectors','planet-list','settlement','ship','solar-systems','universe-planets','moons','coordinates','planet-bonuses','planet-defenses','exploration','alliances','messages','missions','events','targets','spy'];
$rules = [
    'resource' => ['mechanic' => 'resource state = authenticated balance + production − upkeep − queued cost', 'features' => ['balance tiles','production history','consumption forecast','deficit warning']],
    'metal' => ['mechanic' => 'metal net = mines + income − construction − fleet upkeep', 'features' => ['metal balance','mine output','construction demand','turn forecast']],
    'crystal' => ['mechanic' => 'crystal net = crystal production + income − research − crafting demand', 'features' => ['crystal balance','research demand','crafting demand','turn forecast']],
    'deuterium' => ['mechanic' => 'deuterium net = refinery output + income − fuel − research − power demand', 'features' => ['deuterium balance','fuel demand','research demand','shortfall forecast']],
    'energy' => ['mechanic' => 'energy margin = generated power − colony load − fleet load − module draw', 'features' => ['generation','load graph','brownout state','power priorities']],
    'construction' => ['mechanic' => 'build eligibility = ownership + prerequisite + cost + field capacity + queue slot', 'features' => ['build catalogue','level preview','queue timeline','field usage']],
    'shipyard' => ['mechanic' => 'ship production = blueprint cost + yard capacity + queue availability + resource balance', 'features' => ['ship catalogue','yard queue','hull preview','fuel profile']],
    'research' => ['mechanic' => 'research completion = base cost × growth^level with prerequisite and queue validation', 'features' => ['technology tree','prerequisite graph','research queue','effect preview']],
    'fleet' => ['mechanic' => 'fleet mission = validated composition + route distance + propulsion + fuel + cooldown', 'features' => ['fleet roster','formation editor','mission route','arrival forecast']],
    'military' => ['mechanic' => 'combat readiness = units × equipment × technology × morale − fatigue', 'features' => ['force roster','training queue','defense posture','combat readiness']],
    'intelligence' => ['mechanic' => 'intelligence result = sensor power + covert skill − target counter-intelligence', 'features' => ['target profile','detection estimate','classified output','mission history']],
    'galaxy' => ['mechanic' => 'navigation visibility = coordinate scope + discovery state + scan power + permission', 'features' => ['map viewport','coordinate path','scan state','discovery record']],
    'market' => ['mechanic' => 'trade settlement = validated order × price − fee − escrow state', 'features' => ['order book','price bands','escrow state','trade history']],
    'craft' => ['mechanic' => 'craft output = blueprint tier × material quality × skill × station efficiency', 'features' => ['blueprints','materials','craft queue','quality preview']],
    'alliance' => ['mechanic' => 'alliance action = membership role + diplomatic state + project capacity + audit event', 'features' => ['member roster','role matrix','diplomacy map','shared projects']],
    'lifeform' => ['mechanic' => 'lifeform progress = population × role efficiency × tier modifier × morale', 'features' => ['population roles','tier ladder','trait matrix','bonus summary']],
    'activity' => ['mechanic' => 'activity outcome = validated objective + difficulty + cooldown + reward table', 'features' => ['activity board','eligibility check','reward preview','completion history']],
    'prestige' => ['mechanic' => 'prestige state = glory + reputation + ascension milestones − penalties', 'features' => ['milestone ladder','reputation track','title library','permanent modifiers']],
    'rank' => ['mechanic' => 'ranking score = economy + military + technology + glory − penalties', 'features' => ['leaderboard','score breakdown','movement indicator','season snapshot']],
    'premium' => ['mechanic' => 'entitlement = authenticated account + catalogue item + balance + service policy', 'features' => ['store catalogue','entitlement state','expiry timer','purchase confirmation']],
    'account' => ['mechanic' => 'account update = authenticated session + CSRF + policy + audit event', 'features' => ['profile summary','settings','security status','support access']],
];
function keywordRule(string $route, array $rules): array { foreach ($rules as $key => $rule) if (str_contains($route, $key)) return $rule; return []; }
$matrix = [];
foreach ($specs as $route => &$spec) {
    if (in_array($route, $specialized, true)) continue;
    $rule = keywordRule($route, $rules);
    $title = $spec['title'];
    $group = $spec['group'];
    $spec['purpose'] = "$title is the $group subsystem console for authenticated commander operations, review, and validated state transitions.";
    if ($rule) {
        $spec['mechanic'] = $rule['mechanic'];
        $spec['features'] = array_values(array_unique(array_merge($rule['features'], $spec['features'])));
    }
    $spec['functions'] = array_values(array_unique(array_merge([
        "open $title state", 'inspect server-calculated values', 'review related queues and dependencies', 'navigate to linked subsystem'
    ], $spec['functions'])));
    $spec['sub_features'] = array_values(array_unique(array_merge([
        'empty-state explanation', 'loading and refresh state', 'permission-aware controls', 'related-page navigation'
    ], $spec['sub_features'])));
    $spec['information_sections'] = array_values(array_unique(array_merge([
        'Commander context', 'Current state', 'Available controls', 'Dependencies and prerequisites', 'Audit and feedback'
    ], $spec['information_sections'])));
    if (!$spec['buttons']) $spec['buttons'] = [['label' => 'Inspect page', 'action' => 'inspect_page', 'behavior' => 'Read authenticated server contract.']];
    $matrix[$route] = ['title' => $title, 'group' => $group, 'mechanic' => $spec['mechanic'], 'features' => $spec['features'], 'sub_features' => $spec['sub_features'], 'buttons' => $spec['buttons']];
}
unset($spec);
file_put_contents($root . '/config/detailed_page_specs.php', "<?php\ndeclare(strict_types=1);\nreturn " . var_export($specs, true) . ";\n");
file_put_contents($root . '/docs/remaining_page_design_matrix.json', json_encode($matrix, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
echo 'Enriched ' . count($matrix) . " remaining generic routes.\n";
