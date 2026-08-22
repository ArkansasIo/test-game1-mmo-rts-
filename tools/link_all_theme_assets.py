from pathlib import Path
p = Path('/home/ubuntu/stargatewars/game.php')
s = p.read_text()
links = '''<link rel="stylesheet" href="assets/app.css">
<link rel="stylesheet" href="assets/master.css">
<link rel="stylesheet" href="assets/menu-groups.css">
<link rel="stylesheet" href="assets/theme-system.css">
<link rel="stylesheet" href="assets/generated-page-interactions.js">'''
# JS is not a stylesheet; keep only CSS links in the head and let the existing shell script load JS.
links = '''<link rel="stylesheet" href="assets/app.css">
<link rel="stylesheet" href="assets/master.css">
<link rel="stylesheet" href="assets/menu-groups.css">
<link rel="stylesheet" href="assets/theme-system.css">'''
for line in links.splitlines():
    href = line.split('href="', 1)[1].split('"', 1)[0]
    if href not in s:
        s = s.replace('</head>', line + '\n</head>', 1)
p.write_text(s)
print('all theme styles linked')
