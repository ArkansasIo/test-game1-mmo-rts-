from pathlib import Path
import re
source=Path('/tmp/live-game.html')
text=source.read_text()
scripts=re.findall(r'<script[^>]*>(.*?)</script>', text, flags=re.S|re.I)
Path('/tmp/game_inline.js').write_text('\\n'.join(scripts))
print(f'inline_scripts={len(scripts)} bytes={len(Path("/tmp/game_inline.js").read_text())}')
