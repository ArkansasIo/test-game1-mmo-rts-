<?php
declare(strict_types=1);
$root=dirname(__DIR__);
$features=require $root.'/config/gameplay_features.php';
$required=['dashboard','economy','technology','military','intelligence','colonies','fleet','universe','social','progression'];
$missing=array_values(array_diff($required,array_keys($features)));
$actions=file_get_contents($root.'/actions/game.php');
$actionNames=[];
preg_match_all("/case '([^']+)'/",$actions,$m);
$actionNames=array_values(array_unique($m[1]??[]));
$expected=['process_turns','technology','queue_research','combat','covert','colonize_planet','launch_mission','event_join','record_discovery','diplomacy_propose','trade_create','ascend'];
$missingActions=array_values(array_diff($expected,$actionNames));
$migration=file_get_contents($root.'/sql/011_full_gameplay_features.sql');
$tables=['technology_prerequisites','battle_rounds','universe_discoveries','world_event_participants','diplomacy_actions','game_audit_log'];
$missingTables=[];foreach($tables as $table){if(strpos($migration,'CREATE TABLE IF NOT EXISTS '.$table)===false)$missingTables[]=$table;}
$services=['DashboardService.php','GameRulesCatalog.php','GameFeatureService.php'];$missingServices=[];foreach($services as $service){if(!is_file($root.'/includes/services/'.$service))$missingServices[]=$service;}
printf("feature_families=%d\n",count($features));
printf("missing_families=%s\n",$missing?implode(',',$missing):'none');
printf("action_cases=%d\n",count($actionNames));
printf("missing_actions=%s\n",$missingActions?implode(',',$missingActions):'none');
printf("missing_migration_tables=%s\n",$missingTables?implode(',',$missingTables):'none');
printf("missing_services=%s\n",$missingServices?implode(',',$missingServices):'none');
if($missing||$missingActions||$missingTables||$missingServices)exit(1);
