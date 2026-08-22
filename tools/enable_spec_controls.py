from pathlib import Path
path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
old = "const p=all.find(x=>x.key===selected)||all[0],d=routeDetails[selected]||details[p.layout]||{hero:p.title,panels:['Overview','Controls','Activity'],formula:'Validated server-side state transition',controls:p.controls||[],action:(p.actions||[])[0]||null,tables:p.tables||[],permission:'authenticated commander',states:['ready','empty','error']},ic=interactions[p.layout]||{page:p.title,purpose:d.hero,buttons:{}};"
new = "const p=all.find(x=>x.key===selected)||all[0],d=routeDetails[selected]||details[p.layout]||{hero:p.title,panels:['Overview','Controls','Activity'],formula:'Validated server-side state transition',controls:p.controls||[],action:(p.actions||[])[0]||null,tables:p.tables||[],permission:'authenticated commander',states:['ready','empty','error']},ic=interactions[p.layout]||{page:p.title,purpose:d.hero,buttons:{}},specButtons=Object.keys(ic.buttons||{}).length?ic.buttons:Object.fromEntries((s.buttons||[]).map(b=>[b.label,{action:b.action,logic:b.behavior}]));"
if old not in source:
    raise SystemExit('generic renderer metadata anchor not found')
source = source.replace(old, new, 1)
source = source.replace("Object.entries(ic.buttons||{}).map(([label,b])=>", "Object.entries(specButtons||{}).map(([label,b])=>", 1)
path.write_text(source)
print('spec controls enabled')
