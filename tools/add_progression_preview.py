from pathlib import Path
p=Path('/home/ubuntu/stargatewars/modular-pages-preview.php')
s=p.read_text()
old="'commander'=>'Tanang','race'=>'Tau\\'ri','rank'=>'Commander','turns'=>84,"
new="'commander'=>'Tanang','race'=>'Tau\\'ri','rank'=>'Commander','turns'=>84,'progression'=>['tier'=>7,'tier_name'=>'Commander','level'=>14,'global_level'=>152,'next_level'=>153,'progress_percent'=>91,'entity_category'=>'player','entity_key'=>'player_core','effect_percent'=>114.000,'states'=>['available','queued','locked','maximum']],"
if old not in s: raise SystemExit('state marker not found')
s=s.replace(old,new,1)
old="const c=state.colony;const resourceTiles="
new="const c=state.colony;const progression=state.progression;const resourceTiles="
if old not in s: raise SystemExit('renderer marker not found')
s=s.replace(old,new,1)
old='<div class="card wide"><div class="eyebrow">COMMAND ALERTS</div><h2>Events and warnings</h2>\'+alerts+\'</div>'
new='<div class="card wide"><div class="eyebrow">UNIVERSAL PROGRESSION</div><h2>Tier \'+progression.tier+\' / Level \'+progression.level+\' <span class="badge">\'+esc(progression.tier_name)+\'</span></h2><div class="metric-grid"><div class="metric"><span>Global level</span><strong>\'+progression.global_level+\' / 483</strong><small>21 tiers × 23 levels</small></div><div class="metric"><span>Next level</span><strong>\'+progression.next_level+\'</strong><small>\'+progression.progress_percent+\'% progress</small></div><div class="metric"><span>Current effect</span><strong>+\'+progression.effect_percent.toFixed(1)+\'%</strong><small>Player progression modifier</small></div></div><div class="bar"><i style="width:\'+progression.progress_percent+\'%"></i></div><div class="actions" style="margin-top:12px">\'+actionButton(\'progression_advance\',\'Advance player level\',\'dark\')+\' <span class="badge">Server validates cost, prerequisites, and tier cap</span></div></div><div class="card wide"><div class="eyebrow">COMMAND ALERTS</div><h2>Events and warnings</h2>\'+alerts+\'</div>'
if old not in s: raise SystemExit('dashboard insertion marker not found')
s=s.replace(old,new,1)
p.write_text(s)
print('progression panel added')
