from pathlib import Path
root=Path('/home/ubuntu/stargatewars')
for route,title in {'store':'Store','premium-officers':'Officers','commander':'Commander','premium-services':'Premium Services'}.items():
 p=root/'config/page_definitions/premium'/f'{route}.php'; s=p.read_text(); s=s.replace("'title' => 'Premium Store'", "'title' => 'Store'").replace("'title' => 'Premium Officers'", "'title' => 'Officers'")
 if "'contract_files'" not in s:
  insert="""  'contract_files' => array (\n    'logic' => 'config/page_logic/premium/%s.php',\n    'features' => 'config/page_features/premium/%s.php',\n    'design' => 'config/page_design_specs/premium/%s.php',\n    'systems' => 'config/page_systems/premium/%s.php',\n    'module' => 'includes/page_modules/premium/%s.php',\n  ),\n"""%(route,route,route,route,route)
  s=s.replace("  'features' =>",insert+"  'features' =>")
 p.write_text(s)
