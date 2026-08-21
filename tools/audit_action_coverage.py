from pathlib import Path
import re

root = Path('/home/ubuntu/stargatewars')
frontend = (root / 'game.php').read_text()
backend = (root / 'actions/game.php').read_text()
frontend_actions = sorted(set(re.findall(r'name=["\']action["\']\s+value=["\']([^"\']+)', frontend)))
backend_actions = sorted(set(re.findall(r"case\s+['\"]([^'\"]+)['\"]\s*:", backend)))
print('FRONTEND_ACTIONS', len(frontend_actions))
print('\n'.join(frontend_actions))
print('BACKEND_ACTIONS', len(backend_actions))
print('\n'.join(backend_actions))
print('MISSING_BACKEND_CASES')
print('\n'.join(sorted(set(frontend_actions) - set(backend_actions))) or '(none)')
print('UNWIRED_BACKEND_ACTIONS')
print('\n'.join(sorted(set(backend_actions) - set(frontend_actions))) or '(none)')
