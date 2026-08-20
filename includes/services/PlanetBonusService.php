<?php
declare(strict_types=1);

final class PlanetBonusService
{
    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        if($playerId<1)throw new InvalidArgumentException('Invalid planet-bonus request.');$sql="SELECT c.id,c.player_id,c.colony_name,c.colony_level,c.morale,p.id planet_id,p.name planet_name,p.biome,p.metal_modifier,p.food_modifier,p.water_modifier,p.energy_modifier,COALESCE(SUM(pb.bonus_percent),0) building_bonus FROM player_colonies c JOIN universe_planets p ON p.id=c.planet_id LEFT JOIN player_planets legacy ON legacy.player_id=c.player_id AND (legacy.name=c.colony_name OR legacy.name=p.name) LEFT JOIN planet_bonuses pb ON pb.planet_id=legacy.id WHERE c.player_id=? GROUP BY c.id,c.player_id,c.colony_name,c.colony_level,c.morale,p.id,p.name,p.biome,p.metal_modifier,p.food_modifier,p.water_modifier,p.energy_modifier ORDER BY c.id";$s=$this->pdo->prepare($sql);$s->execute([$playerId]);$rows=$s->fetchAll(PDO::FETCH_ASSOC);foreach($rows as &$row){$base=1000*max(1,(int)$row['colony_level']);$biome=((float)$row['metal_modifier']-1.0)*100;$building=(float)$row['building_bonus'];$morale=((float)$row['morale']-1.0)*100;$total=$biome+$building+$morale;$row['base_production']=$base;$row['biome_modifier']=round($biome,3);$row['building_bonus']=round($building,3);$row['morale_adjustment']=round($morale,3);$row['total_bonus']=round($total,3);$row['applied_production']=(int)round($base*(1+$total/100));$row['morale']=(float)$row['morale'];}unset($row);return ['state'=>$rows?'ready':'empty','colonies'=>$rows,'formula'=>'planet bonus = biome modifier + building bonus + morale adjustment','applied_formula'=>'applied production = base production × (1 + total bonus / 100)','states'=>['ready','empty','error']];
    }
}
