<?php
declare(strict_types=1);

const DB_HOST = '127.0.0.1';
const DB_NAME = 'stargatewars';
const DB_USER = 'stargate_app';
const DB_PASS = 'StargateLocal2026';

function db(): ?PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}

function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function number(int|float $value): string { return number_format($value); }

function fallback_menu(): array {
    return [
        ['label'=>'Command Center','route'=>'dashboard','icon'=>'⌂','children'=>[
            ['label'=>'Account Information','route'=>'account-info'],['label'=>'Resources','route'=>'resources'],['label'=>'Income','route'=>'income'],['label'=>'Military Scores','route'=>'military-stats']]],
        ['label'=>'Attack','route'=>'attack','icon'=>'⚔','children'=>[['label'=>'Targets','route'=>'targets'],['label'=>'Spy','route'=>'spy'],['label'=>'Sabotage','route'=>'sabotage'],['label'=>'Attack Log','route'=>'attack-log']]],
        ['label'=>'Armory','route'=>'armory','icon'=>'▣','children'=>[['label'=>'Weapons','route'=>'weapons'],['label'=>'Buy / Sell','route'=>'weapon-market'],['label'=>'Repair','route'=>'repair']]],
        ['label'=>'Training','route'=>'training','icon'=>'◈','children'=>[['label'=>'Units','route'=>'units'],['label'=>'Miners','route'=>'miners'],['label'=>'Super Units','route'=>'super-units'],['label'=>'Unit Production','route'=>'unit-production']]],
        ['label'=>'Technology','route'=>'technology','icon'=>'◇','children'=>[['label'=>'Offense','route'=>'tech-offense'],['label'=>'Defense','route'=>'tech-defense'],['label'=>'Covert','route'=>'tech-covert'],['label'=>'Anti-Covert','route'=>'tech-anti-covert']]],
        ['label'=>'Intelligence','route'=>'intelligence','icon'=>'◎','children'=>[['label'=>'Spy Log','route'=>'spy-log'],['label'=>'Enemy Intelligence','route'=>'enemy-intelligence']]],
        ['label'=>'Market','route'=>'market','icon'=>'¤','children'=>[['label'=>'Resource Exchange','route'=>'resource-exchange'],['label'=>'Mercenary Market','route'=>'mercenary-market']]],
        ['label'=>'Social','route'=>'social','icon'=>'♧','children'=>[['label'=>'Rankings','route'=>'rankings'],['label'=>'Alliances','route'=>'alliances'],['label'=>'Messages','route'=>'messages']]],
        ['label'=>'Planets','route'=>'planets','icon'=>'○','children'=>[['label'=>'Planet List','route'=>'planet-list'],['label'=>'Bonuses','route'=>'planet-bonuses'],['label'=>'Defenses','route'=>'planet-defenses']]],
        ['label'=>'Mothership','route'=>'mothership','icon'=>'△','children'=>[['label'=>'Ship','route'=>'ship'],['label'=>'Modules','route'=>'modules'],['label'=>'Exploration','route'=>'exploration']]],
        ['label'=>'Account','route'=>'account','icon'=>'◌','children'=>[['label'=>'Race','route'=>'race'],['label'=>'Vacation','route'=>'vacation'],['label'=>'Ascension','route'=>'ascension']]],
        ['label'=>'Universe','route'=>'universe','icon'=>'✦','children'=>[['label'=>'Galaxy Map','route'=>'galaxies'],['label'=>'Sector Map','route'=>'sectors'],['label'=>'Solar Systems','route'=>'solar-systems'],['label'=>'Universe Planets','route'=>'universe-planets'],['label'=>'Moon Registry','route'=>'moons'],['label'=>'Coordinate Search','route'=>'coordinates']]],
    ];
}

function menu_tree(): array {
    $pdo = db();
    if (!$pdo) return fallback_menu();
    try {
        $rows = $pdo->query('SELECT * FROM menu_items ORDER BY parent_id IS NOT NULL, parent_id, sort_order')->fetchAll();
        $byId = []; $tree = [];
        foreach ($rows as $row) { $row['children'] = []; $byId[$row['id']] = $row; }
        foreach ($byId as $id => &$row) {
            if ($row['parent_id']) $byId[$row['parent_id']]['children'][] =& $row; else $tree[] =& $row;
        }
        unset($row);
        return $tree ?: fallback_menu();
    } catch (Throwable $e) { return fallback_menu(); }
}

function page_title(string $route): string {
    return ucwords(str_replace('-', ' ', $route));
}
?>
