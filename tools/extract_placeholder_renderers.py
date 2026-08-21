from pathlib import Path
import re

source = Path('/home/ubuntu/stargatewars/game.php').read_text()
names = ['sabotagePage', 'reportsPage', 'weaponsPage', 'attackPage', 'militaryStatsPage']
for name in names:
    match = re.search(r'function\s+' + re.escape(name) + r'\s*\([^)]*\)', source)
    if not match:
        print('missing', name)
        continue
    start = match.start()
    next_match = re.search(r'function\s+[A-Za-z0-9_]+Page\s*\([^)]*\)', source[match.end():])
    end = match.end() + next_match.start() if next_match else len(source)
    Path('/tmp/' + name + '.txt').write_text(source[start:end])
    print(name, end - start)
