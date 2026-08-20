from pathlib import Path
s = Path('/home/ubuntu/stargatewars/game.php').read_text()
for needle in ['const registry=', 'function genericPage(){', 'function render(){']:
    i = s.find(needle)
    print('\nNEEDLE', needle, 'OFFSET', i)
    print(s[i:i+4200])
