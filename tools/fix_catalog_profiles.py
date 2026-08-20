from pathlib import Path
path = Path('/home/ubuntu/stargatewars/config/page_contract_catalog.php')
lines = path.read_text().splitlines()
fixed = []
for line in lines:
    stripped = line.rstrip()
    if stripped.endswith(']],') and "' => [" in stripped:
        line = stripped[:-3] + ']]],'
    fixed.append(line)
path.write_text('\n'.join(fixed) + '\n')
print('processed', len(lines), 'lines')
