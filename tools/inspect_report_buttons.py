from pathlib import Path
s=Path('/home/ubuntu/stargatewars/game.php').read_text()
start=s.index('function reportsPage')
end=s.index('function ', start+10)
segment=s[start:end]
for needle in ['data-action=\\"read_report\\"','data-action=\\"message_read\\"','data-action=\"read_report\"','data-action=\"message_read\"']:
    pos=segment.find(needle)
    print(needle, pos)
    if pos>=0: print(repr(segment[max(0,pos-240):pos+420]))
