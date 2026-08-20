from pathlib import Path
import json

graph=json.loads(Path('/home/ubuntu/stargatewars/schema_graph.json').read_text())
lines=['erDiagram']
for table in graph['tables']:
    # Keep the overview readable while the webpage exposes all columns.
    lines.append(f'    {table["name"]} {{')
    for col in table['columns'][:8]:
        # Mermaid ER attributes accept simple type tokens; preserve the column name and use a safe token.
        raw=col['type'].upper()
        safe='STRING' if raw.startswith(('VARCHAR','CHAR','TEXT','ENUM','JSON','DATETIME','TIMESTAMP','VARBINARY')) else ('DECIMAL' if raw.startswith('DECIMAL') else raw.split('(')[0])
        lines.append(f'        {safe} {col["name"]}')
    lines.append('    }')
seen=set()
for r in graph['relationships']:
    key=(r['from_table'],r['to_table'])
    if key in seen: continue
    seen.add(key)
    lines.append(f'    {r["to_table"]} ||--o{{ {r["from_table"]} : "{r["from_column"]}"')
Path('/home/ubuntu/stargatewars/schema-overview.mmd').write_text('\n'.join(lines)+'\n')
print(f'wrote {len(graph["tables"])} tables and {len(seen)} unique relationship edges')
