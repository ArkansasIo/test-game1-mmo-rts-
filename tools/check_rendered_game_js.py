from pathlib import Path
import re
import sys
source = Path(sys.argv[1]).read_text()
match = re.search(r'<script[^>]*>(.*?)</script>', source, re.S)
if not match:
    raise SystemExit('rendered script block not found')
Path('/tmp/stargatewars-rendered-game.js').write_text(match.group(1))
print('rendered_script_bytes=', len(match.group(1).encode()))
