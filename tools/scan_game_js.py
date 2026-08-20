from pathlib import Path
s = Path('/tmp/stargatewars-rendered-game.js').read_text()
for line_no, line in enumerate(s.splitlines(), 1):
    quote = None
    escape = False
    for i, ch in enumerate(line):
        if quote:
            if escape:
                escape = False
            elif ch == '\\':
                escape = True
            elif ch == quote:
                quote = None
        elif ch in "'\"`":
            quote = ch
    if quote:
        print('unclosed_quote line=', line_no, 'quote=', quote, 'length=', len(line))
        print('tail=', repr(line[-300:]))
