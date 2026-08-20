<?php
declare(strict_types=1);
namespace SGW\Engine;
final class LifeSupportEngine {
    public function tick(array $colony,int $elapsedSeconds):array{
        if($elapsedSeconds<0)throw new \InvalidArgumentException('Elapsed seconds cannot be negative');
        $hours=$elapsedSeconds/3600;$population=max(0,(int)$colony['population']);$foodCost=(int)ceil($population*.25*$hours);$waterCost=(int)ceil($population*.20*$hours);$food=max(0,(int)$colony['food_stock']-$foodCost);$water=max(0,(int)$colony['water_stock']-$waterCost);$shortage=$food===0||$water===0;$growth=$shortage?0:(int)floor($population*.01*$hours*max(0,(float)($colony['morale']??1)));$populationAfter=min((int)$colony['population_capacity'],$population+$growth);return ['hours'=>$hours,'food_cost'=>$foodCost,'water_cost'=>$waterCost,'food_after'=>$food,'water_after'=>$water,'shortage'=>$shortage,'population_after'=>$populationAfter];
    }
}
