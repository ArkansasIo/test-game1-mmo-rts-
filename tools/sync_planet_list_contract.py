from pathlib import Path

path = Path(__file__).resolve().parents[1] / 'config/page_definitions/planets/planet-list.php'
text = path.read_text(encoding='utf-8')
replacements = [
("""  'controls' => \n  array (\n    0 => 'Explore',\n    1 => 'Conquer',\n  ),""", """  'controls' => \n  array (\n    0 => 'Explore',\n    1 => 'Colonize',\n    2 => 'Upgrade defense',\n  ),"""),
("""  'actions' => \n  array (\n    0 => 'explore',\n    1 => 'combat',\n  ),""", """  'actions' => \n  array (\n    0 => 'explore',\n    1 => 'combat',\n    2 => 'colonize_planet',\n    3 => 'planet_defense',\n  ),"""),
("""  'tables' => \n  array (\n    0 => 'player_planets',\n    1 => 'planet_explorations',\n  ),""", """  'tables' => \n  array (\n    0 => 'player_colonies',\n    1 => 'planet_bonuses',\n    2 => 'planet_explorations',\n    3 => 'player_resources',\n    4 => 'universe_planets',\n    5 => 'planet_defenses',\n    6 => 'motherships',\n    7 => 'player_cooldowns',\n    8 => 'game_events',\n  ),""", 1),
("'formula' => 'colony state = production − food/water upkeep + morale and habitability modifiers',", "'formula' => 'colony output = base production × biome × race × government × morale',"),
("'action' => 'planet_defense',", "'action' => 'explore / colonize_planet / planet_defense',"),
("""    'permission' => 'authenticated colony owner',\n    'states' => \n    array (\n      0 => 'ready',\n      1 => 'empty',\n      2 => 'protected',\n      3 => 'insufficient-resource',\n      4 => 'success',\n      5 => 'error',\n    ),""", """    'permission' => 'authenticated commander · colony ownership · target validation',\n    'states' => \n    array (\n      0 => 'ready',\n      1 => 'empty',\n      2 => 'protected',\n      3 => 'success',\n      4 => 'error',\n    ),"""),
("'purpose' => 'Manage worlds, biomes, defenses, and life support.',", "'purpose' => 'Manage owned colonies, life support, production output, and fleet presence.'"),
("""        'states' => \n        array (\n          0 => 'ready',\n          1 => 'cooldown',\n          2 => 'success',\n          3 => 'error',\n        ),""", """        'states' => \n        array (\n          0 => 'ready',\n          1 => 'empty',\n          2 => 'protected',\n          3 => 'success',\n          4 => 'error',\n        ),""", 1),
("""        'states' => \n        array (\n          0 => 'ready',\n          1 => 'occupied',\n          2 => 'protected',\n          3 => 'insufficient-resource',\n          4 => 'success',\n          5 => 'error',\n        ),""", """        'states' => \n        array (\n          0 => 'ready',\n          1 => 'empty',\n          2 => 'protected',\n          3 => 'success',\n          4 => 'error',\n        ),""", 1),
("""        'states' => \n        array (\n          0 => 'ready',\n          1 => 'insufficient-resource',\n          2 => 'success',\n          3 => 'error',\n        ),""", """        'states' => \n        array (\n          0 => 'ready',\n          1 => 'empty',\n          2 => 'protected',\n          3 => 'success',\n          4 => 'error',\n        ),""", 1),
]
for item in replacements:
    old, new = item[:2]
    count = item[2] if len(item) == 3 else 1
    if old not in text:
        raise SystemExit(f'missing expected text: {old[:80]}')
    text = text.replace(old, new, count)
path.write_text(text, encoding='utf-8')
print(path)
