from pathlib import Path

root = Path('/home/ubuntu/stargatewars')
# Parse registry with PHP itself to JSON so duplicate labels and exact route keys remain authoritative.
import subprocess, json
code = '''$r=require "config/page_registry.php"; $o=[]; foreach($r as $g=>$v){foreach(($v["pages"]??[]) as $route=>$page){$o[]=["group"=>$g,"group_label"=>$v["label"]??$g,"route"=>$route,"title"=>$page["title"]??$route];}} echo json_encode($o);'''
proc = subprocess.run(['php','-r',code], cwd=root, capture_output=True, text=True, check=True)
routes = json.loads(proc.stdout)
menu_root = root/'menus'
menu_root.mkdir(exist_ok=True)
path_map = {}
for item in routes:
    group, route = item['group'], item['route']
    group_dir = menu_root/group
    sub_dir = group_dir/'submenus'
    sub_dir.mkdir(parents=True, exist_ok=True)
    (group_dir/'index.php').write_text(f'''<?php\ndeclare(strict_types=1);\n// Named menu entry: {item['group_label']}\nreturn require __DIR__ . '/../../pages/{group}/index.php';\n''')
    target = f"../../pages/{group}/subpages/{route}.php"
    (sub_dir/f'{route}.php').write_text(f'''<?php\ndeclare(strict_types=1);\n// Named submenu page: {item['title']} ({route})\nreturn require __DIR__ . '/{target}';\n''')
    path_map[route] = {'menu': f'menus/{group}/index.php', 'submenu': f'menus/{group}/submenus/{route}.php', 'legacy_page': f'pages/{route}.php', 'title': item['title'], 'group': group}
map_lines = ['<?php', 'declare(strict_types=1);', 'return [']
for route, data in path_map.items():
    map_lines.append('    '+repr(route)+' => ['+ ', '.join(repr(k)+' => '+repr(v) for k,v in data.items()) + '],')
map_lines += ['];', '']
(root/'config/menu_page_paths.php').write_text('\n'.join(map_lines))
(root/'docs/named_menu_tree.md').write_text('# Named PHP Menu Tree\n\n`game.php` remains the authenticated shell. Each registered route also has an explicit named menu entry under `menus/{group}/index.php` and a named submenu page under `menus/{group}/submenus/{route}.php`. Existing `pages/` entries remain compatibility aliases.\n\nRoutes: '+str(len(routes))+'\nMenus: '+str(len(set(x['group'] for x in routes)))+'\n')
print(f'created named menu tree for {len(routes)} routes')
