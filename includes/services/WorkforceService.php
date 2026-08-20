<?php
declare(strict_types=1);

final class WorkforceService
{
    public const MINER_EFFICIENCY = 80;
    public const LIFER_EFFICIENCY = 20;

    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        $s=$this->pdo->prepare("SELECT c.id,c.name,c.coordinate,c.population,c.population_capacity,c.morale,c.food_stock,c.water_stock,c.workforce,COALESCE(SUM(CASE WHEN pa.role='miners' THEN pa.assigned_population ELSE 0 END),0) miners,COALESCE(SUM(CASE WHEN pa.role='lifers' THEN pa.assigned_population ELSE 0 END),0) lifers FROM colonies c LEFT JOIN population_assignments pa ON pa.colony_id=c.id WHERE c.player_id=? GROUP BY c.id,c.name,c.coordinate,c.population,c.population_capacity,c.morale,c.food_stock,c.water_stock,c.workforce ORDER BY c.is_homeworld DESC,c.name");$s->execute([$playerId]);$colonies=[];foreach($s->fetchAll() as $c){$miners=(int)$c['miners'];$lifers=(int)$c['lifers'];$morale=(float)$c['morale'];$minerOutput=(int)round($miners*self::MINER_EFFICIENCY*$morale);$liferOutput=(int)round($lifers*self::LIFER_EFFICIENCY*$morale);$supportLoad=(int)round(($c['population']??0)*0.45);$assigned=$miners+$lifers;$colonies[]=['id'=>(int)$c['id'],'name'=>$c['name'],'coordinate'=>$c['coordinate'],'population'=>(int)$c['population'],'population_capacity'=>(int)$c['population_capacity'],'morale_percent'=>round($morale*100,1),'miners'=>$miners,'lifers'=>$lifers,'assigned_population'=>$assigned,'unassigned_population'=>max(0,(int)$c['population']-$assigned),'miner_output'=>$minerOutput,'lifer_output'=>$liferOutput,'total_output'=>$minerOutput+$liferOutput,'support_load'=>$supportLoad,'food_stock'=>(int)$c['food_stock'],'water_stock'=>(int)$c['water_stock'],'workforce'=>(int)$c['workforce'],'ownership'=>'verified'];}$r=$this->pdo->prepare('SELECT miners,lifers,untrained_units,unit_production,population,population_capacity FROM player_resources WHERE player_id=?');$r->execute([$playerId]);$global=$r->fetch()?:[];$totalMiners=array_sum(array_column($colonies,'miners'));$totalLifers=array_sum(array_column($colonies,'lifers'));return ['colonies'=>$colonies,'global'=>$global,'total_miners'=>$totalMiners,'total_lifers'=>$totalLifers,'total_output'=>array_sum(array_column($colonies,'total_output')),'total_support_load'=>array_sum(array_column($colonies,'support_load')),'formula'=>'workforce output = assigned population × role efficiency × morale','efficiencies'=>['miners'=>self::MINER_EFFICIENCY,'lifers'=>self::LIFER_EFFICIENCY],'states'=>['ready','empty','insufficient-resource','success','error']];
    }
}
