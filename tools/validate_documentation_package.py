from pathlib import Path
import re
import sys

ROOT = Path('/home/ubuntu/stargatewars')
DOC = ROOT / 'docs/universe-civilization-documentation'
errors=[]

md_files=sorted(DOC.rglob('*.md'))
for path in md_files:
    text=path.read_text(errors='replace')
    for target in re.findall(r'\[[^\]]+\]\(([^)#]+)(?:#[^)]+)?\)', text):
        if target.startswith(('http://','https://','mailto:')):
            continue
        target=target.strip()
        resolved=(path.parent/target).resolve()
        if not resolved.exists():
            errors.append(f'{path.relative_to(ROOT)} -> missing link target {target}')

for mmd in sorted((DOC/'uml').glob('*.mmd')):
    if not mmd.read_text(errors='replace').strip():
        errors.append(f'empty diagram: {mmd.relative_to(ROOT)}')
    png=DOC/'uml/rendered'/(mmd.stem+'.png')
    if not png.exists():
        errors.append(f'missing rendered diagram: {png.relative_to(ROOT)}')

route_doc=(DOC/'frontend/DASHBOARD_43_ROUTE_REFERENCE.md').read_text(errors='replace')
registry=(ROOT/'config/page_registry.php').read_text(errors='replace')
registry_routes=set(re.findall(r"^\s*'([a-z0-9_-]+)'\s*=>\s*\['title'", registry, re.M))
doc_routes=set(re.findall(r'`([a-z0-9_-]+)`', route_doc))
missing=sorted(r for r in registry_routes if r not in doc_routes and r not in {'planets'})
for route in missing:
    errors.append(f'route missing from dashboard route reference: {route}')

for required in ['README.md','DOCUMENTATION_MANIFEST.md','gdd/GDD.md','gdd/IMPLEMENTATION_STATUS.md','source-reference/source_file_catalog.md','source-reference/sql_migration_catalog.md','source-reference/dashboard_route_catalog.md','source-reference/service_catalog.md']:
    if not (DOC/required).exists():
        errors.append(f'missing required documentation file: {required}')

print(f'markdown_files={len(md_files)} diagrams={len(list((DOC/"uml").glob("*.mmd")))} registry_routes={len(registry_routes)}')
if errors:
    print('ERRORS')
    print('\n'.join(errors))
    sys.exit(1)
print('documentation validation passed')
