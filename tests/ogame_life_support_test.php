<?php
declare(strict_types=1);
require_once __DIR__.'/../src/Engine/LifeSupportEngine.php';
use SGW\Engine\LifeSupportEngine;
function expect_value(string $name,mixed $actual,mixed $expected):void{if($actual!==$expected){fwrite(STDERR,"FAIL {$name}: expected ".var_export($expected,true)." got ".var_export($actual,true).PHP_EOL);exit(1);}echo "PASS {$name}".PHP_EOL;}
$engine=new LifeSupportEngine();
$normal=$engine->tick(['population'=>100,'population_capacity'=>1000,'food_stock'=>1000,'water_stock'=>1000,'morale'=>1.0],3600);
expect_value('food cost',$normal['food_cost'],25);expect_value('water cost',$normal['water_cost'],20);expect_value('population growth',$normal['population_after'],101);expect_value('normal shortage',$normal['shortage'],false);
$short=$engine->tick(['population'=>100,'population_capacity'=>1000,'food_stock'=>1,'water_stock'=>1000,'morale'=>1.0],3600);
expect_value('food depletion',$short['food_after'],0);expect_value('shortage stops growth',$short['population_after'],100);expect_value('shortage flag',$short['shortage'],true);
$cap=$engine->tick(['population'=>100,'population_capacity'=>100,'food_stock'=>1000,'water_stock'=>1000,'morale'=>1.0],86400);
expect_value('population capacity',$cap['population_after'],100);
$zero=$engine->tick(['population'=>0,'population_capacity'=>100,'food_stock'=>0,'water_stock'=>0,'morale'=>1.0],0);
expect_value('zero population',$zero['population_after'],0);expect_value('zero elapsed food',$zero['food_cost'],0);
echo "All OGame life-support tests passed.".PHP_EOL;
