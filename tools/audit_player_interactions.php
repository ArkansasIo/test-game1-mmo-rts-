<?php
declare(strict_types=1);
$root=dirname(__DIR__);
$registry=require $root.'/config/page_registry.php';
$contracts=require $root.'/config/player_interaction_contracts.php';
$layouts=[];$routes=0;$missing=[];$buttonCount=0;
foreach($registry as $group){foreach(($group['pages']??[]) as $route=>$page){$routes++;$layout=(string)($page['layout']??'');$layouts[$layout]=true;if(!isset($contracts[$layout]))$missing[]=$layout;}}
foreach($contracts as $contract){$buttonCount+=count($contract['buttons']??[]);}
$actions=file_get_contents($root.'/actions/game.php');
$actionCases=[];preg_match_all("/case '([^']+)'/",$actions,$m);$actionCases=array_unique($m[1]??[]);
$contractActions=[];foreach($contracts as $contract){foreach(($contract['buttons']??[]) as $button){$action=(string)($button['action']??'');if($action!==''&&!str_starts_with($action,'navigate:')&&!str_contains($action,':'))$contractActions[]=$action;}}
$unwired=[];foreach(array_unique($contractActions) as $action){if(!in_array($action,$actionCases,true)&&!in_array($action,['read_income_breakdown','read_colony_comparison','read_military_stats','read_weapon','read_report','read_profile','read_rank','read_protection','read_ascension','read_galaxy','read_sector','read_covert','read_message','coordinate_lookup','planet_details','moon_details'],true))$unwired[]=$action;}
printf("registered_routes=%d\n",$routes);
printf("contract_layouts=%d\n",count($contracts));
printf("registered_layouts=%d\n",count($layouts));
printf("interaction_buttons=%d\n",$buttonCount);
printf("missing_layout_contracts=%s\n",$missing?implode(',',array_unique($missing)):'none');
printf("unwired_mutating_actions=%s\n",$unwired?implode(',',array_unique($unwired)):'none');
if($missing||$unwired)exit(1);
