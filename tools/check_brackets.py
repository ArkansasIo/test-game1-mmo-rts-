from pathlib import Path
s = Path('/home/ubuntu/stargatewars/config/page_contract_catalog.php').read_text()
stack = []
quote = None
escape = False
for i, ch in enumerate(s):
    if quote:
        if escape:
            escape = False
        elif ch == '\\':
            escape = True
        elif ch == quote:
            quote = None
        continue
    if ch in "'\"":
        quote = ch
    elif ch in '[{(':
        stack.append((ch, i))
    elif ch in ']})':
        expected = {']':'[','}':'{',')':'('}[ch]
        if not stack or stack[-1][0] != expected:
            line = s.count('\n', 0, i) + 1
            print(f'unexpected {ch} at line {line}, offset {i}, stack_tail={stack[-5:]}')
            raise SystemExit(1)
        stack.pop()
print('remaining_stack=', [(ch, s.count('\n', 0, pos)+1) for ch, pos in stack[-10:]])
