<?php
declare(strict_types=1);
function stargatewars_premium_premium_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/premium/premium.php'; }
function stargatewars_premium_premium_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/premium/premium.php'; }
function stargatewars_premium_premium_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/premium/premium.php'; }
function stargatewars_premium_premium_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/premium/premium.php'; }
function stargatewars_premium_premium_actions(): array { return stargatewars_premium_premium_systems()['actions'] ?? []; }
function stargatewars_premium_premium_validate_intent(array $input): array {
 $errors=[]; $action=(string)($input['action']??''); if($action===''||!in_array($action,stargatewars_premium_premium_actions(),true)) $errors['action']='Action is not permitted for this Premium page.';
 if(isset($input['quantity']) && ((int)$input['quantity']<1||(int)$input['quantity']>10)) $errors['quantity']='Quantity must be between 1 and 10.';
 return ['valid'=>$errors===[],'errors'=>$errors,'action'=>$action];
}
function stargatewars_premium_premium_preview(array $context=[]): array { return ['route'=>'premium','title'=>'Premium Hub','logic'=>stargatewars_premium_premium_logic(),'features'=>stargatewars_premium_premium_features(),'design'=>stargatewars_premium_premium_design(),'systems'=>stargatewars_premium_premium_systems(),'context'=>$context]; }
