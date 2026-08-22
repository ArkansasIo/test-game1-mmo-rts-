from pathlib import Path

path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
tag = '<script src="assets/generated-page-interactions.js"></script>'
if tag not in source:
    for anchor in ['</body></html>', '</body>', '</html>']:
        if anchor in source:
            source = source.replace(anchor, tag + anchor, 1)
            break
    else:
        raise SystemExit('No closing HTML anchor found')
    path.write_text(source)
    print('AJAX script included')
else:
    print('AJAX script already included')
