from pathlib import Path
out = Path('/tmp/game_js_check.out').read_text().splitlines()
source_lines = Path('/tmp/stargatewars-rendered-game.js').read_text().splitlines()
print('diagnostic_lines=', len(out))
for idx, line in enumerate(out):
    if '^' in line:
        col = line.index('^')
        print('caret_column=', col)
        source = source_lines[0] if len(source_lines) == 1 else source_lines[5]
        print('source_line_length=', len(source))
        print('near=', repr(source[max(0,col-220):col+220]))
        break
else:
    print('caret_not_found', repr(out[2][-120:] if len(out) > 2 else ''))
    print('caret_codepoints=', [(i, ord(ch)) for i, ch in enumerate(out[2]) if ord(ch) not in (32, 9)][:20])
