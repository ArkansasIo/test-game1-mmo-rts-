from pathlib import Path
import re
import json

schema_path = Path('/home/ubuntu/stargatewars/sql/000_complete_database.sql')
out_path = Path('/home/ubuntu/stargatewars/schema_graph.json')
sql = schema_path.read_text()
tables = []
blocks = list(re.finditer(r'CREATE TABLE IF NOT EXISTS\s+(\w+)\s*\((.*?)\n\);', sql, re.S | re.I))
for block in blocks:
    name, body = block.group(1), block.group(2)
    columns = []
    for line in body.splitlines():
        line = line.strip().rstrip(',')
        match = re.match(r'(\w+)\s+([A-Z][A-Z0-9_]*(?:\([^)]*\))?)', line, re.I)
        if match and not line.upper().startswith(('PRIMARY KEY', 'UNIQUE KEY', 'FOREIGN KEY', 'INDEX', 'CONSTRAINT')):
            columns.append({'name': match.group(1), 'type': match.group(2)})
    tables.append({'name': name, 'columns': columns})

relationships = []
for block in blocks:
    table_name, body = block.group(1), block.group(2)
    for col, parent, target_col in re.findall(r'FOREIGN KEY\s*\((\w+)\)\s+REFERENCES\s+(\w+)\s*\((\w+)\)', body, re.I):
        relationships.append({
            'from_table': table_name,
            'from_column': col,
            'to_table': parent,
            'to_column': target_col,
        })

data = {'table_count': len(tables), 'relationship_count': len(relationships), 'tables': tables, 'relationships': relationships}
out_path.write_text(json.dumps(data, indent=2))
print(json.dumps({'table_count': len(tables), 'relationship_count': len(relationships)}))
