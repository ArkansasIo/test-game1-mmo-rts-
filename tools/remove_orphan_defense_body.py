from pathlib import Path
path=Path('/home/ubuntu/stargatewars/game.php')
text=path.read_text()
start=text.find("const d=state.defense_technology||{};")
end=text.find("function weaponRepairPage(){", start)
if start < 0 or end < 0:
    raise SystemExit(f'orphan block bounds not found: start={start} end={end}')
path.write_text(text[:start] + text[end:])
print('removed orphaned legacy defense renderer body')
