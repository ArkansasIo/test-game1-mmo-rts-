from pathlib import Path

path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
link = '<link rel="stylesheet" href="assets/menu-groups.css">'
if link not in source:
    marker = '<style>'
    if marker not in source:
        raise SystemExit('game.php style anchor not found')
    source = source.replace(marker, link + marker, 1)
    path.write_text(source)
    print('menu-groups.css linked')
else:
    print('menu-groups.css already linked')
