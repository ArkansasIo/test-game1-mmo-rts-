from pathlib import Path

path = Path('/home/ubuntu/stargatewars/game.php')
source = path.read_text()
source = source.replace("$routeDetails = require __DIR__ . '/config/page_route_details.php';", "$routeDetails = require __DIR__ . '/config/page_route_details.php';\n$detailedPageSpecs = require __DIR__ . '/config/detailed_page_specs.php';", 1)
source = source.replace("$routeDetailsJson = json_encode($routeDetails, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_THROW_ON_ERROR);", "$routeDetailsJson = json_encode($routeDetails, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_THROW_ON_ERROR);\n$detailedPageSpecsJson = json_encode($detailedPageSpecs, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_THROW_ON_ERROR);", 1)
source = source.replace("const registry=<?=$registryJson?>,details=<?=$pageDetailsJson?>,routeDetails=<?=$routeDetailsJson?>,interactions=<?=$interactionJson?>,pageContracts=<?=$pageContractsJson?>,state=<?=$stateJson?>,permissions=<?=$permissionJson?>;", "const registry=<?=$registryJson?>,details=<?=$pageDetailsJson?>,routeDetails=<?=$routeDetailsJson?>,detailedSpecs=<?=$detailedPageSpecsJson?>,interactions=<?=$interactionJson?>,pageContracts=<?=$pageContractsJson?>,state=<?=$stateJson?>,permissions=<?=$permissionJson?>;", 1)
start = source.find('function genericPage(){')
end = source.find('function render(){', start)
if start < 0 or end < 0:
    raise SystemExit('generic renderer block not found')
block = source[start:end]
if 'const s=detailedSpecs[selected]||{}' not in block:
    block = block.replace('function genericPage(){const p=', 'function genericPage(){const s=detailedSpecs[selected]||{};const p=', 1)
    design = "const designHtml='<div class=\\\"card wide\\\"><div class=\\\"eyebrow\\\">SYSTEM DESIGN</div><h2>Functions &amp; mechanics</h2><p class=\\\"permission\\\">'+esc(s.purpose||d.hero)+'</p><div class=\\\"row\\\"><strong>Mechanic</strong><span>'+esc(s.mechanic||d.formula)+'</span></div><div class=\\\"row\\\"><strong>Functions</strong><span>'+esc((s.functions||[]).join(' · '))+'</span></div><div class=\\\"row\\\"><strong>Features</strong><span>'+esc((s.features||[]).join(' · '))+'</span></div><div class=\\\"row\\\"><strong>Sub-features</strong><span>'+esc((s.sub_features||[]).join(' · '))+'</span></div><div class=\\\"row\\\"><strong>Information</strong><span>'+esc((s.information_sections||[]).join(' · '))+'</span></div></div>';"
    block = block.replace("document.getElementById('section').textContent=", design + "document.getElementById('section').textContent=", 1)
    block = block.replace("'<div id=\"intent-feedback\"", "'+designHtml+'<div id=\"intent-feedback\"", 1)
source = source[:start] + block + source[end:]
path.write_text(source)
print('detailed specs integrated')
