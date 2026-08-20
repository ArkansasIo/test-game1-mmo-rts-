from pathlib import Path
import re
p=Path('/home/ubuntu/stargatewars/sql/002_seed_subpage_data.sql')
s=p.read_text()
s=s.replace('INSERT INTO page_content (route, section, title, description, sort_order) VALUES','INSERT INTO page_content (route, section, title, description) VALUES')
head, sep, tail = s.partition('INSERT INTO page_content')
tail = re.sub(r",\s*\d+\)(?=,|\nON DUPLICATE)", ')', tail)
s = head + sep + tail
s=s.replace("),\nON DUPLICATE KEY UPDATE", "\nON DUPLICATE KEY UPDATE")
p.write_text(s)
print('page_content seed repaired')
