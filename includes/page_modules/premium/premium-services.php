<?php
declare(strict_types=1);
function stargatewars_premium_premium_services_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/premium/premium-services.php'; }
function stargatewars_premium_premium_services_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/premium/premium-services.php'; }
function stargatewars_premium_premium_services_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/premium/premium-services.php'; }
function stargatewars_premium_premium_services_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/premium/premium-services.php'; }
function stargatewars_premium_premium_services_actions(): array { return stargatewars_premium_premium_services_systems()['actions'] ?? []; }
function stargatewars_premium_premium_services_validate_intent(array $input): array {
 $errors=[]; $action=(string)($input['action']??''); if($action===''||!in_array($action,stargatewars_premium_premium_services_actions(),true)) $errors['action']='Action is not permitted for this Premium page.';
 if(isset($input['quantity']) && ((int)$input['quantity']<1||(int)$input['quantity']>10)) $errors['quantity']='Quantity must be between 1 and 10.';
 return ['valid'=>$errors===[],'errors'=>$errors,'action'=>$action];
}
function stargatewars_premium_premium_services_preview(array $context=[]): array { return ['route'=>'premium-services','title'=>'Premium Services','logic'=>stargatewars_premium_premium_services_logic(),'features'=>stargatewars_premium_premium_services_features(),'design'=>stargatewars_premium_premium_services_design(),'systems'=>stargatewars_premium_premium_services_systems(),'context'=>$context]; }
