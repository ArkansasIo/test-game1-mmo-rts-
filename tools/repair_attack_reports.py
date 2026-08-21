from pathlib import Path

path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
old_prefix = "function reportsPage(){const reports=state.reports||[];const fallback="
new_prefix = "function reportsPage(){const csrf=state.csrf||'';const reports=state.reports||[];const reportForm=(kind,id,action,label)=>'<form method=\"post\" action=\"actions/game.php\" class=\"inline-form\">'+csrf+'<input type=\"hidden\" name=\"action\" value=\"'+action+'\"><input type=\"hidden\" name=\"redirect\" value=\"attack-log\"><input type=\"hidden\" name=\"report_kind\" value=\"'+esc(kind||'battle')+'\"><input type=\"hidden\" name=\"report_id\" value=\"'+fmt(id||0)+'\"><button class=\"button\" type=\"submit\">'+label+'</button></form>';const fallback="
if old_prefix not in source:
    raise SystemExit('reportsPage prefix not found')
source = source.replace(old_prefix, new_prefix, 1)
old_row = "<button class=\"button report-intent\" data-kind=\"'+esc(r.report_kind||'battle')+'\" data-id=\"'+esc(r.report_id||0)+'\" data-action=\"read_report\">Open report</button> <button class=\"button report-intent\" data-kind=\"'+esc(r.report_kind||'battle')+'\" data-id=\"'+esc(r.report_id||0)+'\" data-action=\"message_read\">Mark read</button>"
new_row = "'+reportForm(r.report_kind,r.report_id,'read_report','Open report')+reportForm(r.report_kind,r.report_id,'message_read','Mark read')+'"
if old_row not in source:
    raise SystemExit('dynamic report row buttons not found')
source = source.replace(old_row, new_row, 1)
old_side = "<button class=\"button report-intent\" data-kind=\"'+esc((reports[0]||{}).report_kind||'battle')+'\" data-id=\"'+esc((reports[0]||{}).report_id||0)+'\" data-action=\"read_report\">Open report</button>"
new_side = "'+reportForm((reports[0]||{}).report_kind,(reports[0]||{}).report_id,'read_report','Open report')+'"
if old_side not in source:
    raise SystemExit('side open-report button not found')
source = source.replace(old_side, new_side, 1)
old_side_read = "<button class=\"button report-intent\" data-kind=\"'+esc((reports[0]||{}).report_kind||'battle')+'\" data-id=\"'+esc((reports[0]||{}).report_id||0)+'\" data-action=\"message_read\">Mark read</button>"
new_side_read = "'+reportForm((reports[0]||{}).report_kind,(reports[0]||{}).report_id,'message_read','Mark read')+'"
if old_side_read not in source:
    raise SystemExit('side mark-read button not found')
source = source.replace(old_side_read, new_side_read, 1)
path.write_text(source)
print('updated dynamic Attack Log report controls')
