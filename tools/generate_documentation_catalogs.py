from pathlib import Path
import re
from datetime import date

ROOT = Path('/home/ubuntu/stargatewars')
OUT = ROOT / 'docs/universe-civilization-documentation/source-reference'
OUT.mkdir(parents=True, exist_ok=True)

skip = {'.git', 'node_modules', 'docs/universe-civilization-documentation'}

def files(exts):
    rows=[]
    for p in ROOT.rglob('*'):
        if not p.is_file() or p.suffix.lower() not in exts:
            continue
        rel=p.relative_to(ROOT).as_posix()
        if any(rel == s or rel.startswith(s + '/') for s in skip):
            continue
        rows.append((rel,p))
    return sorted(rows)

def heading_for(path):
    stem=path.stem.replace('_',' ').replace('-',' ')
    return stem.title()

php=files({'.php'})
sql=files({'.sql'})
js_css=files({'.js','.css'})
md=files({'.md'})

def table(rows, columns):
    out=['| '+' | '.join(columns)+' |','|'+'|'.join('---' for _ in columns)+'|']
    out += ['| '+' | '.join(r)+' |' for r in rows]
    return '\n'.join(out)

source_rows=[]
for rel,p in php:
    text=p.read_text(errors='replace')
    lines=text.count('\n')+1
    kind='PHP source'
    if rel.startswith('config/'): kind='Configuration / contract'
    elif rel.startswith('includes/services/'): kind='Authoritative service'
    elif rel.startswith('includes/page_modules/'): kind='Page module'
    elif rel.startswith('pages/'): kind='Page entry'
    elif rel.startswith('actions/'): kind='HTTP action handler'
    elif rel.startswith('tests/'): kind='Test'
    elif rel.startswith('cron/') or rel.startswith('08_Cron/'): kind='Scheduled job'
    source_rows.append((f'`{rel}`',kind,str(lines)))
(OUT/'source_file_catalog.md').write_text('# Source File Catalog\n\nGenerated from the repository on '+str(date.today())+'. This catalog lists PHP files outside the dedicated documentation package. The current implementation uses both the numbered architecture folders and the active root/config/includes/pages/action tree; both are retained here for traceability.\n\n'+table(source_rows,['Path','Role','Lines'])+'\n')

sql_rows=[]
for rel,p in sql:
    text=p.read_text(errors='replace')
    tables=sorted(set(re.findall(r'\\b(?:CREATE\\s+TABLE(?:\\s+IF\\s+NOT\\s+EXISTS)?|ALTER\\s+TABLE|INSERT\\s+INTO|UPDATE|DELETE\\s+FROM)\\s+`?([A-Za-z0-9_]+)',text,re.I)))
    sql_rows.append((f'`{rel}`',', '.join(f'`{x}`' for x in tables[:8]) or '—',str(text.count('\n')+1)))
(OUT/'sql_migration_catalog.md').write_text('# SQL Migration and Schema Catalog\n\nGenerated from the repository on '+str(date.today())+'. Migration execution order is numeric filename order unless the deployment runbook specifies an exception. Table extraction is heuristic and should be checked against the SQL when adding new migrations.\n\n'+table(sql_rows,['Migration / schema file','Detected tables','Lines'])+'\n')

route_text=(ROOT/'config/page_registry.php').read_text(errors='replace')
route_rows=[]
for m in re.finditer(r"'([^']+)'\s*=>\s*\['title'\s*=>\s*'([^']+)'\s*,\s*'layout'\s*=>\s*'([^']+)'\s*,\s*'controls'\s*=>\s*\[(.*?)\]\s*,\s*'actions'\s*=>\s*\[(.*?)\]\s*,\s*'tables'\s*=>\s*\[(.*?)\]\]\s*,?", route_text, re.S):
    route, title, layout, controls, actions, tables = m.groups()
    clean=lambda x: ', '.join(re.findall(r"'([^']+)'",x)) or '—'
    route_rows.append((f'`{route}`',title,layout,clean(controls),clean(actions),clean(tables)))
(OUT/'dashboard_route_catalog.md').write_text('# Dashboard Route Catalog\n\nThe dashboard is a server-authenticated, JavaScript-driven shell. The registry below is the navigation contract for the active dashboard routes. Each route must have a page definition, page module, route metadata, and a renderer or intentional fallback.\n\n'+table(route_rows,['Route','Title','Layout','Controls','Actions','Tables'])+'\n')

service_rows=[]
for rel,p in files({'.php'}):
    if '/services/' not in rel: continue
    text=p.read_text(errors='replace')
    classes=', '.join(re.findall(r'final class\s+([A-Za-z0-9_]+)',text)) or '—'
    methods=', '.join(re.findall(r'public function\s+([A-Za-z0-9_]+)\s*\(',text)) or '—'
    service_rows.append((f'`{rel}`',classes,methods))
(OUT/'service_catalog.md').write_text('# Service Catalog\n\nThe service layer is authoritative for gameplay calculations and mutations. Controllers should validate request shape and delegate state changes to services.\n\n'+table(service_rows,['File','Class','Public methods'])+'\n')

print(f'php={len(php)} sql={len(sql)} js_css={len(js_css)} md={len(md)} routes={len(route_rows)} services={len(service_rows)}')
