from pathlib import Path
path = Path('/home/ubuntu/stargatewars/index.php')
text = path.read_text()
needle = '<div class="metrics-grid">'
insert = '''<?php if ($route==='dashboard' && ($dashboardSnapshot['resources'] || $dashboardSnapshot['colonies'] || $dashboardSnapshot['queues'] || $dashboardSnapshot['missions'])): ?>
<div class="panel table-panel"><div class="panel-head"><div><p class="kicker">LIVE SERVER SNAPSHOT</p><h3>Database-backed operations</h3></div><span class="badge">AUTHORITATIVE</span></div><div class="stat-list"><div><span>Colonies loaded</span><strong><?=number(count($dashboardSnapshot['colonies']))?></strong></div><div><span>Active queues</span><strong><?=number(count($dashboardSnapshot['queues']))?></strong></div><div><span>Fleet missions</span><strong><?=number(count($dashboardSnapshot['missions']))?></strong></div><div><span>Recent events</span><strong><?=number(count($dashboardSnapshot['alerts']))?></strong></div></div></div>
<?php endif; ?>
<div class="metrics-grid">'''
if needle not in text:
    raise SystemExit('dashboard metrics marker not found')
path.write_text(text.replace(needle, insert, 1))
print('dashboard_snapshot_panel=added')
