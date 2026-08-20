<?php
declare(strict_types=1);
namespace SGW\Engine;
final class Formulas {
    public static function upCost(int $up):int{return ($up*5000)+10000;}
    public static function naturalIncome(int $uu,int $miners,int $lifers,float $raceIncome=1.0,float $defcon=1.0):int{return max(0,(int)floor((($uu*20)+(($miners+$lifers)*80))*$raceIncome*$defcon));}
    public static function bankCapacity(int $income):int{return max(0,(int)floor($income*48*1.5));}
    public static function strike(int $normal,int $super,float $tech=1.0,float $race=1.0,float $planet=0.0,float $ship=0.0):float{return (($normal*5)+($super*10)+$planet+$ship)*$tech*$race;}
    public static function defense(int $normal,int $super,float $tech=1.0,float $race=1.0,float $planet=0.0,float $ship=0.0):float{return (($normal*5)+($super*10)+$planet+$ship)*$tech*$race;}
    public static function covert(int $count,int $level,float $tech=1.0,float $race=1.0,float $planet=0.0):float{return ((sqrt(2**max(0,$level))*$count*$tech*$race)+$count+$planet)*10;}
    public static function antiCovert(int $count,int $level,float $tech=1.0,float $race=1.0,float $planet=0.0):float{return ((sqrt(2**max(0,$level+2))*$count*$tech*$race)+$count+$planet)*10;}
}
