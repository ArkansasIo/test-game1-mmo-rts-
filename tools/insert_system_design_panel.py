from pathlib import Path
path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
old = "+'</p></div><div class=\"card wide\"><div class=\"eyebrow\">SERVER ACTIONS / DATABASE</div>"
new = "+'</p></div>'+designHtml+'<div class=\"card wide\"><div class=\"eyebrow\">SERVER ACTIONS / DATABASE</div>"
if old not in source:
    raise SystemExit('generic server-contract anchor not found')
source = source.replace(old, new, 1)
path.write_text(source)
print('system design panel inserted')
