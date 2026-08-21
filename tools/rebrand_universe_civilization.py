from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
SKIP_PARTS = {'.git', 'node_modules', 'storage'}
EXTENSIONS = {'.php', '.md', '.html', '.js', '.json', '.txt', '.sql', '.py'}
replacements = [
    ('UNIVERSE CIVILIZATION: EMPIRE AT WARS', 'UNIVERSE CIVILIZATION: EMPIRE AT WARS'),
    ('Universe Civilization: Empire at Wars', 'Universe Civilization: Empire at Wars'),
    ('Universe Civilization: Empire at Wars', 'Universe Civilization: Empire at Wars'),
]
changed = []
for path in ROOT.rglob('*'):
    if not path.is_file() or path.suffix.lower() not in EXTENSIONS:
        continue
    if any(part in SKIP_PARTS for part in path.parts):
        continue
    try:
        original = path.read_text(encoding='utf-8')
    except UnicodeDecodeError:
        continue
    updated = original
    for old, new in replacements:
        updated = updated.replace(old, new)
    if updated != original:
        path.write_text(updated, encoding='utf-8')
        changed.append(str(path.relative_to(ROOT)))
print(f'updated_files={len(changed)}')
for item in changed:
    print(item)
