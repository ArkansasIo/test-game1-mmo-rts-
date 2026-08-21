from pathlib import Path
path=Path('/home/ubuntu/stargatewars/game.php')
s=path.read_text()
needle='function alliancesPage(){'
positions=[]
start=0
while True:
    i=s.find(needle,start)
    if i<0: break
    positions.append(i); start=i+1
if len(positions)<2:
    raise SystemExit(f'expected duplicate alliances marker, found {len(positions)}')
i=positions[-1]
s=s[:i]+'function genericPage(){'+s[i+len(needle):]
path.write_text(s)
print('restored genericPage marker')
