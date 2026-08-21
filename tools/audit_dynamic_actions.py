from pathlib import Path
import re
source = Path('/home/ubuntu/stargatewars/game.php').read_text()
patterns = [
    r"action\s*[:=]\s*['\"]([A-Za-z0-9_:-]+)['\"]",
    r"value=['\"]([A-Za-z0-9_:-]+)['\"]",
    r"['\"]action['\"]\s*,\s*['\"]([A-Za-z0-9_:-]+)['\"]",
]
found = set()
for pattern in patterns:
    found.update(re.findall(pattern, source))
print('DYNAMIC_OR_LITERAL_ACTIONS', len(found))
for action in sorted(found):
    print(action)
