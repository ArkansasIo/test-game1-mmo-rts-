<?php
declare(strict_types=1);
$root=dirname(__DIR__);
$sql=file_get_contents($root.'/sql/012_races_governments_registration.sql');
$raceBlock=substr($sql,strpos($sql,'INSERT INTO races'),strpos($sql,'INSERT INTO government_types')-strpos($sql,'INSERT INTO races'));
$governmentBlock=substr($sql,strpos($sql,'INSERT INTO government_types'),strpos($sql,'UPDATE players')-strpos($sql,'INSERT INTO government_types'));
$raceCount=preg_match_all("/\n\('[^']+(?:\\\\'[^']+)?'/",$raceBlock,$x);
$governmentCount=preg_match_all("/\n\('[a-z_]+','[^']+'/",$governmentBlock,$y);
$actions=file_get_contents($root.'/actions/game.php');
$required=['select_registration_faction','reform_government'];$missing=[];foreach($required as $action){if(strpos($actions,"case '$action'")===false)$missing[]=$action;}
printf("seeded_race_rows=%d\n",$raceCount);
printf("seeded_government_rows=%d\n",$governmentCount);
printf("missing_faction_actions=%s\n",$missing?implode(',',$missing):'none');
printf("migration_has_registration_column=%s\n",strpos($sql,'registration_completed_at')!==false?'yes':'no');
if($raceCount!==5||$governmentCount!==9||$missing)exit(1);
