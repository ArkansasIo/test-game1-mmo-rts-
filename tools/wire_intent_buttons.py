from pathlib import Path
import re

path = Path('/home/ubuntu/stargatewars/game.php')
text = path.read_text()
marker = 'function render(){'
helper = r'''function submitIntent(action,redirect,payload){const form=document.createElement('form');form.method='POST';form.action='actions/game.php';form.style.display='none';form.innerHTML=state.csrf||'';const add=(name,value)=>{const input=document.createElement('input');input.type='hidden';input.name=name;input.value=value==null?'':String(value);form.appendChild(input)};add('action',action);add('redirect',redirect||selected||'dashboard');Object.entries(payload||{}).forEach(([name,value])=>add(name,value));document.body.appendChild(form);form.submit()}function bindIntentButtons(selector,redirect){document.querySelectorAll(selector).forEach(button=>button.onclick=()=>{let action=button.dataset.action||'';const payload={};if(action==='choose_target'){submitIntent('read_target_board','targets',{});return}if(action==='review_reports'){window.location.href='game.php?page=attack-log';return}if(action==='open_colony'){window.location.href='game.php?page=planet-list';return}if(action==='dispatch_fleet'){window.location.href='game.php?page=missions';return}if(action==='progression_advance'){payload.entity_category='player';payload.entity_key='player_core';}if(button.dataset.target)payload.target_id=button.dataset.target;if(button.dataset.weapon)payload.weapon_type_id=button.dataset.weapon;if(button.dataset.report)payload.report_id=button.dataset.report;if(button.dataset.reportKind)payload.report_kind=button.dataset.reportKind;if(action==='weapon_buy')payload.quantity=button.dataset.quantity||1;if(action==='set_defcon')payload.level=button.dataset.level||2;if(action==='message_read'&&button.dataset.message)payload.message_id=button.dataset.message;if(action==='read_report'&&!payload.report_id){const feedback=document.getElementById(button.dataset.feedback||'feedback');if(feedback){feedback.style.display='block';feedback.textContent='Select a report before opening it.'}return}submitIntent(action,redirect,payload)})}
'''
text, helper_count = re.subn(r'function submitIntent\(action,redirect,payload\).*?function render\(\)\{', helper + marker, text, count=1, flags=re.S)
if helper_count == 0:
    text = text.replace(marker, helper + marker, 1)
replacements = {
    r"document\.querySelectorAll\('\.server-action'\)\.forEach\(b=>b\.onclick=.*?\}\)": "bindIntentButtons('.server-action','dashboard')",
    r"document\.querySelectorAll\('\.income-intent'\)\.forEach\(button=>button\.onclick=.*?\}\)": "bindIntentButtons('.income-intent','income')",
    r"document\.querySelectorAll\('\.sabotage-intent'\)\.forEach\(b=>b\.onclick=.*?\}\)": "bindIntentButtons('.sabotage-intent','sabotage')",
    r"document\.querySelectorAll\('\.report-intent'\)\.forEach\(b=>b\.onclick=.*?\}\)": "bindIntentButtons('.report-intent','attack-log')",
    r"document\.querySelectorAll\('\.weapon-intent'\)\.forEach\(b=>b\.onclick=.*?\}\)": "bindIntentButtons('.weapon-intent','weapons')",
    r"document\.querySelectorAll\('\.attack-intent'\)\.forEach\(button=>button\.onclick=.*?\}\)": "bindIntentButtons('.attack-intent','targets')",
    r"document\.querySelectorAll\('\.military-intent'\)\.forEach\(button=>button\.onclick=.*?\}\)": "bindIntentButtons('.military-intent','military-stats')",
}
for pattern, replacement in replacements.items():
    text, count = re.subn(pattern, replacement, text, count=1, flags=re.S)
    print(pattern, count)
page_handler = "document.querySelectorAll('.page-intent').forEach(button=>button.onclick=()=>{const feedback=document.getElementById('intent-feedback');feedback.style.display='block';feedback.textContent='Intent preview accepted: '+button.dataset.action+' → target validation → CSRF/RBAC check → server action contract.'})"
page_replacement = "document.querySelectorAll('.page-intent').forEach(button=>button.onclick=()=>{const action=button.dataset.action||'';const safeReadActions=['read_income_breakdown','read_colony_comparison','read_military_stats','read_target_board','read_covert_state','read_weapon_inventory','read_equipment_catalog','inspect_durability','refresh_rankings','settlement_state'];if(safeReadActions.includes(action)){submitIntent(action,selected||'dashboard',{});return}const feedback=document.getElementById('intent-feedback');feedback.style.display='block';feedback.textContent='Intent preview accepted: '+action+' → target validation → CSRF/RBAC check → server action contract.'})"
if page_handler in text:
    text = text.replace(page_handler, page_replacement, 1)
path.write_text(text)
print('helper wired')
