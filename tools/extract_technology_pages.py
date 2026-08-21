from pathlib import Path
import re
text=Path('/home/ubuntu/stargatewars/game.php').read_text()
for name in ['technologyTreePage','offenseTechnologyPage','defenseTechnologyPage','covertTechnologyPage','antiCovertTechnologyPage']:
    m=re.search(r'function '+re.escape(name)+r'\([^)]*\)\{', text)
    if not m:
        print(f'\nMISSING {name}')
        continue
    start=m.start(); depth=0; end=None
    for i in range(m.end()-1,len(text)):
        if text[i]=='{': depth+=1
        elif text[i]=='}':
            depth-=1
            if depth==0:
                end=i+1; break
    print(f'\n===== {name} =====\n{text[start:end]}')
