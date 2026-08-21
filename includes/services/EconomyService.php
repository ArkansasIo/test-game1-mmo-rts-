<?php
declare(strict_types=1);
final class EconomyService {
    public function __construct(private PDO $pdo) {}
    public function calculatePopulationState(array $colony, float $foodAvailability=1.0, float $waterAvailability=1.0): array {
        $population=max(0,(int)($colony['population']??0));
        $capacity=max(0,(int)($colony['population_capacity']??0));
        $foodRate=max(0,(float)($colony['food_rate']??0.25));
        $waterRate=max(0,(float)($colony['water_rate']??0.20));
        $growthRate=max(0,(float)($colony['growth_rate']??0.01));
        $foodUse=(int)ceil($population*$foodRate);
        $waterUse=(int)ceil($population*$waterRate);
        $foodAvailability=max(0.0,min(1.0,$foodAvailability));
        $waterAvailability=max(0.0,min(1.0,$waterAvailability));
        $growth=(int)min(max(0,$capacity-$population),floor($population*$growthRate*$foodAvailability*$waterAvailability));
        return ['population'=>$population,'capacity'=>$capacity,'food_use'=>$foodUse,'water_use'=>$waterUse,'growth'=>$growth,'food_availability'=>$foodAvailability,'water_availability'=>$waterAvailability,'workforce'=>min($capacity,$population+$growth)];
    }
    public function settlePlayerColonies(int $playerId,int $hours=1): array {
        if($playerId<1||$hours<1) throw new InvalidArgumentException('Invalid player settlement request');
        $s=$this->pdo->prepare('SELECT id FROM colonies WHERE player_id=? ORDER BY id');$s->execute([$playerId]);$results=[];
        foreach($s->fetchAll(PDO::FETCH_COLUMN) as $colonyId){$results[]=$this->settleColony($playerId,(int)$colonyId,$hours);}
        return $results;
    }
    public function settleColony(int $playerId,int $colonyId,int $hours=1): array {
        if($playerId<1||$colonyId<1||$hours<1||$hours>168)throw new InvalidArgumentException('Invalid colony settlement request');
        $this->pdo->beginTransaction();
        try {
            $s=$this->pdo->prepare('SELECT * FROM colonies WHERE id=? AND player_id=? FOR UPDATE');$s->execute([$colonyId,$playerId]);$c=$s->fetch(PDO::FETCH_ASSOC);if(!$c)throw new RuntimeException('Colony not found');
            $food=(int)$c['food_stock'];$water=(int)$c['water_stock'];$before=$this->calculatePopulationState($c, $food>0?1.0:0.0, $water>0?1.0:0.0);$foodUse=$before['food_use']*$hours;$waterUse=$before['water_use']*$hours;$foodAfter=max(0,$food-$foodUse);$waterAfter=max(0,$water-$waterUse);$foodConsumed=$food-$foodAfter;$waterConsumed=$water-$waterAfter;$foodAvailability=$foodUse>0?min(1.0,$food/$foodUse):1.0;$waterAvailability=$waterUse>0?min(1.0,$water/$waterUse):1.0;$calc=$this->calculatePopulationState($c,$foodAvailability,$waterAvailability);$populationAfter=min((int)$c['population_capacity'],(int)$c['population']+$calc['growth']*$hours);$morale=(float)$c['morale'];$shortage=($foodAfter===0&&$foodUse>0)||($waterAfter===0&&$waterUse>0);$morale=max(0.0,min(1.0,$morale+($shortage?-0.03:0.005)*$hours));
            $this->pdo->prepare('UPDATE colonies SET food_stock=?,water_stock=?,population=?,morale=?,workforce=?,updated_at=CURRENT_TIMESTAMP WHERE id=?')->execute([$foodAfter,$waterAfter,$populationAfter,$morale,min($populationAfter,$populationAfter),$colonyId]);
            $stmt=$this->pdo->prepare('INSERT INTO colony_turn_snapshots(colony_id,processed_at,elapsed_seconds,food_before,food_after,water_before,water_after,population_before,population_after,payload) VALUES(?,NOW(),?,?,?,?,?,?,?,?)');$stmt->execute([$colonyId,$hours*3600,$food,$foodAfter,$water,$waterAfter,(int)$c['population'],$populationAfter,json_encode(['food_use'=>$foodUse,'water_use'=>$waterUse,'growth'=>$calc['growth'],'shortage'=>$shortage],JSON_THROW_ON_ERROR)]);
            foreach([['food',-$foodConsumed],['water',-$waterConsumed],['population',$populationAfter-(int)$c['population']]] as [$key,$amount]){$this->pdo->prepare('INSERT INTO resource_transactions(player_id,colony_id,resource_key,amount,reason,metadata) VALUES(?,?,?,?,?,?)')->execute([$playerId,$colonyId,$key,$amount,'colony_settlement',json_encode(['hours'=>$hours,'shortage'=>$shortage],JSON_THROW_ON_ERROR)]);}
            $this->pdo->commit();return ['colony_id'=>$colonyId,'food_before'=>$food,'food_after'=>$foodAfter,'water_before'=>$water,'water_after'=>$waterAfter,'population_before'=>(int)$c['population'],'population_after'=>$populationAfter,'growth'=>$populationAfter-(int)$c['population'],'shortage'=>$shortage,'morale'=>$morale];
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
    public function incomeBreakdown(int $playerId): array {
        if ($playerId < 1) throw new InvalidArgumentException('Invalid player income request');
        $s = $this->pdo->prepare('SELECT p.id,p.protected_until,p.vacation_until,r.name AS race_name,r.income_modifier AS race_modifier,g.name AS government_name,g.economy_modifier AS government_modifier FROM players p JOIN races r ON r.id=p.race_id LEFT JOIN government_types g ON g.id=p.government_id WHERE p.id=?');
        $s->execute([$playerId]);
        $identity = $s->fetch(PDO::FETCH_ASSOC);
        if (!$identity) throw new RuntimeException('Player not found');
        $r = $this->pdo->prepare('SELECT * FROM player_resources WHERE player_id=?');
        $r->execute([$playerId]);
        $resources = $r->fetch(PDO::FETCH_ASSOC);
        if (!$resources) return ['state'=>'empty','colonies'=>[],'formula'=>'settlement = (base production × race modifier × government modifier × technology) − upkeep'];
        $t = $this->pdo->prepare("SELECT COALESCE(SUM(pt.level * t.effect_value),0) FROM player_technologies pt LEFT JOIN technologies t ON t.technology_key=pt.technology_key WHERE pt.player_id=? AND pt.category='economy'");
        $t->execute([$playerId]);
        $technology = 1.0 + ((float)$t->fetchColumn() / 100.0);
        $race = (float)($identity['race_modifier'] ?? 1.0);
        $government = (float)($identity['government_modifier'] ?? 1.0);
        $base = ((int)($resources['untrained_units'] ?? 0) * 20) + (((int)($resources['miners'] ?? 0) + (int)($resources['lifers'] ?? 0)) * 80);
        $food = (int)($resources['food'] ?? 0); $water = (int)($resources['water'] ?? 0); $energy = (int)($resources['energy'] ?? 0); $population = (int)($resources['population'] ?? 0);
        $upkeep = ['food'=>min($food, (int)ceil($population * 0.25)), 'water'=>min($water, (int)ceil($population * 0.20)), 'energy'=>min($energy, (int)ceil($population * 0.05))];
        $upkeepTotal = array_sum($upkeep); $gross = $base * $race * $government * $technology;
        $coloniesStmt = $this->pdo->prepare('SELECT pc.id,pc.colony_name,pc.planet_id,pc.moon_id,pc.is_homeworld,pc.population,pc.food,pc.water,pc.morale,pc.colony_level,up.name AS planet_name,up.coordinate_label,up.planet_class,up.biome,up.habitability,up.metal_modifier,up.crystal_modifier,up.food_modifier,up.water_modifier,up.energy_modifier FROM player_colonies pc LEFT JOIN universe_planets up ON up.id=pc.planet_id WHERE pc.player_id=? ORDER BY pc.is_homeworld DESC,pc.id ASC');
        $coloniesStmt->execute([$playerId]);
        $colonies=[]; foreach ($coloniesStmt->fetchAll(PDO::FETCH_ASSOC) as $colony) { $colonies[]=['id'=>(int)$colony['id'],'name'=>$colony['colony_name'],'planet_id'=>(int)($colony['planet_id']??0),'planet_name'=>$colony['planet_name'],'coordinate'=>$colony['coordinate_label'],'planet_class'=>$colony['planet_class'],'biome'=>$colony['biome'],'habitability'=>(float)($colony['habitability']??0),'population'=>(int)$colony['population'],'food'=>(int)$colony['food'],'water'=>(int)$colony['water'],'morale'=>(float)$colony['morale'],'colony_level'=>(int)$colony['colony_level'],'modifiers'=>['metal'=>(float)($colony['metal_modifier']??1),'crystal'=>(float)($colony['crystal_modifier']??1),'food'=>(float)($colony['food_modifier']??1),'water'=>(float)($colony['water_modifier']??1),'energy'=>(float)($colony['energy_modifier']??1)]]; }
        $now=new DateTimeImmutable('now'); $protected=($identity['protected_until'] && new DateTimeImmutable($identity['protected_until'])>$now) || ($identity['vacation_until'] && new DateTimeImmutable($identity['vacation_until'])>$now);
        return ['state'=>$protected?'protected':($colonies?'ready':'empty'),'base_production'=>$base,'race_name'=>$identity['race_name'],'race_modifier'=>$race,'government_name'=>$identity['government_name'] ?? 'Unassigned','government_modifier'=>$government,'technology_modifier'=>$technology,'gross_output'=>(int)round($gross),'upkeep'=>$upkeep,'upkeep_total'=>$upkeepTotal,'net_settlement'=>max(0,(int)round($gross-$upkeepTotal)),'colony_count'=>count($colonies),'colonies'=>$colonies,'formula'=>'settlement = (base production × race modifier × government modifier × technology) − upkeep'];
    }
    public function colonyComparison(int $playerId): array {
        if ($playerId < 1) throw new InvalidArgumentException('Invalid colony comparison request');
        $s = $this->pdo->prepare('SELECT c.id,c.name,c.coordinate,c.population,c.population_capacity,c.food_stock,c.water_stock,c.morale,c.food_rate,c.water_rate,COALESCE(up.biome, c.planet_type) biome FROM colonies c LEFT JOIN player_colonies pc ON pc.player_id=c.player_id LEFT JOIN universe_planets up ON up.id=pc.planet_id WHERE c.player_id=? ORDER BY c.id');
        $s->execute([$playerId]);
        $rows = [];
        foreach ($s->fetchAll(PDO::FETCH_ASSOC) as $colony) {
            $population = (int)$colony['population'];
            $foodUse = (int)ceil($population * (float)($colony['food_rate'] ?? 0.25));
            $waterUse = (int)ceil($population * (float)($colony['water_rate'] ?? 0.20));
            $rows[] = ['id'=>(int)$colony['id'],'name'=>$colony['name'],'coordinate'=>$colony['coordinate'],'biome'=>$colony['biome'],'population'=>$population,'capacity'=>(int)$colony['population_capacity'],'morale'=>(float)$colony['morale'],'food_efficiency'=>$foodUse>0?round(min(1,(int)$colony['food_stock']/$foodUse)*100):100,'water_efficiency'=>$waterUse>0?round(min(1,(int)$colony['water_stock']/$waterUse)*100):100,'life_support_efficiency'=>($foodUse+$waterUse)>0?round(min(1,((int)$colony['food_stock']+(int)$colony['water_stock'])/($foodUse+$waterUse))*100):100];
        }
        return $rows;
    }
}
