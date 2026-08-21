from pathlib import Path
import re
source=Path('/tmp/local_game.html') if Path('/tmp/local_game.html').exists() else Path('/home/ubuntu/stargatewars/game.php')
text=source.read_text()
scripts=re.findall(r'<script[^>]*>(.*?)</script>', text, flags=re.S|re.I)
Path('/tmp/game_inline.js').write_text('\n'.join(scripts))
print(f'inline_scripts={len(scripts)} bytes={len(Path("/tmp/game_inline.js").read_text())}')
