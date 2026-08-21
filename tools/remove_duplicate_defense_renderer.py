from pathlib import Path
path=Path('/home/ubuntu/stargatewars/game.php')
text=path.read_text()
needle='function defenseTechnologyPage(){'
starts=[]
pos=0
while True:
    idx=text.find(needle,pos)
    if idx<0: break
    starts.append(idx)
    pos=idx+len(needle)
if len(starts) < 2:
    raise SystemExit(f'expected duplicate defense renderer, found {len(starts)}')
start=starts[1]
brace=text.find('{',start)
depth=0
end=None
for i in range(brace,len(text)):
    if text[i]=='{': depth+=1
    elif text[i]=='}':
        depth-=1
        if depth==0:
            end=i+1
            break
if end is None:
    raise SystemExit('could not locate renderer end')
path.write_text(text[:start]+text[end:])
print('removed obsolete duplicate defenseTechnologyPage renderer')
