from pathlib import Path
import re
source=Path('/home/ubuntu/stargatewars/game.php').read_text()
matches=list(re.finditer(r'function\s+([A-Za-z0-9_]+Page)\(\)', source))
for i,m in enumerate(matches):
    name=m.group(1)
    end=matches[i+1].start() if i+1 < len(matches) else len(source)
    chunk=source[m.start():end]
    actions=sorted(set(re.findall(r"value=['\"]([A-Za-z0-9_:-]+)['\"]", chunk)))
    print(f'{name}: {", ".join(actions) if actions else "(no static action value)"}')
