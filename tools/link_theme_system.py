from pathlib import Path

path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
link = '<link rel="stylesheet" href="assets/theme-system.css">'
if link not in source:
    anchor = '<link rel="stylesheet" href="assets/menu-groups.css">'
    if anchor in source:
        source = source.replace(anchor, anchor + link, 1)
    else:
        source = source.replace('<style>', link + '<style>', 1)
    path.write_text(source)
    print('theme-system.css linked')
else:
    print('theme-system.css already linked')
