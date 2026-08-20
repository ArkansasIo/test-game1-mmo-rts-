from pathlib import Path
import re
s = Path('/home/ubuntu/stargatewars/game.php').read_text()
match = re.search(r'<script>\n(.*?)\n</script>', s, re.S)
if not match:
    raise SystemExit('script block not found')
Path('/tmp/stargatewars-game.js').write_text(match.group(1))
print('extracted_bytes=', len(match.group(1).encode()))
