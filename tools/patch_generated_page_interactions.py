from pathlib import Path

path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
script_tag = '<script src="assets/generated-page-interactions.js"></script>'
if script_tag not in source:
    anchor = '</script></body></html>'
    if anchor not in source:
        raise SystemExit('game.php closing script anchor not found')
    source = source.replace(anchor, '</script>' + script_tag + '</body></html>', 1)

replacements = [
    ("<span class=\\\"badge\\\">OPEN</span>", "<button class=\\\"button generated-intent\\\" data-generated-intent=\\\"inspect_page\\\" data-route=\\\"'+esc(selected)+'\\\">Inspect</button>"),
    ("<span class=\\\"badge\\\">OPEN</span>", "<button class=\\\"button generated-intent\\\" data-generated-intent=\\\"inspect_page\\\" data-route=\\\"'+esc(selected)+'\\\">Inspect</button>"),
]
old = '<span class=\\"badge\\">OPEN</span>'
new = '<button class=\\"button generated-intent\\" data-generated-intent=\\"inspect_page\\" data-route=\\"\'+esc(selected)+\'\\">Inspect</button>'
if old in source and 'data-generated-intent' not in source:
    source = source.replace(old, new, 1)
# Add a refresh button to the generic controls panel if that panel exists.
old_controls = "<h2>Available operations</h2>'+controls.map"
new_controls = "<h2>Available operations</h2><button class=\\\"button generated-intent\\\" data-generated-intent=\\\"refresh_page\\\" data-route=\\\"'+esc(selected)+'\\\">Refresh state</button>'+controls.map"
if old_controls in source and 'data-generated-intent=\\\"refresh_page' not in source:
    source = source.replace(old_controls, new_controls, 1)
path.write_text(source)
print('generated page interactions patched')
