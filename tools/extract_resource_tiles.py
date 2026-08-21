from pathlib import Path
import re
text = Path('/home/ubuntu/stargatewars/game.php').read_text()
for pattern in [r'const resourceTiles.*?;const', r'let resourceTiles.*?;const', r'var resourceTiles.*?;const']:
    match = re.search(pattern, text, re.S)
    if match:
        print(match.group(0))
        break
else:
    for token in ('resourceTiles', 'resource-strip'):
        print(token, [m.start() for m in re.finditer(token, text)][:10])
