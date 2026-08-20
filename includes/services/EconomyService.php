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
            $food=(int)$c['food_stock'];$water=(int)$c['water_stock'];$before=$this->calculatePopulationState($c, $food>0?1.0:0.0, $water>0?1.0:0.0);$foodUse=$before['food_use']*$hours;$waterUse=$before['water_use']*$hours;$foodAfter=max(0,$food-$foodUse);$waterAfter=max(0,$water-$waterUse);$foodAvailability=$foodUse>0?min(1.0,$food/$foodUse):1.0;$waterAvailability=$waterUse>0?min(1.0,$water/$waterUse):1.0;$calc=$this->calculatePopulationState($c,$foodAvailability,$waterAvailability);$populationAfter=min((int)$c['population_capacity'],(int)$c['population']+$calc['growth']*$hours);$morale=(float)$c['morale'];$shortage=($foodAfter===0&&$foodUse>0)||($waterAfter===0&&$waterUse>0);$morale=max(0.0,min(1.0,$morale+($shortage?-0.03:0.005)*$hours));
            $this->pdo->prepare('UPDATE colonies SET food_stock=?,water_stock=?,population=?,morale=?,workforce=?,updated_at=CURRENT_TIMESTAMP WHERE id=?')->execute([$foodAfter,$waterAfter,$populationAfter,$morale,min($populationAfter,$populationAfter),$colonyId]);
            $stmt=$this->pdo->prepare('INSERT INTO colony_turn_snapshots(colony_id,processed_at,elapsed_seconds,food_before,food_after,water_before,water_after,population_before,population_after,payload) VALUES(?,NOW(),?,?,?,?,?,?,?,?)');$stmt->execute([$colonyId,$hours*3600,$food,$foodAfter,$water,$waterAfter,(int)$c['population'],$populationAfter,json_encode(['food_use'=>$foodUse,'water_use'=>$waterUse,'growth'=>$calc['growth'],'shortage'=>$shortage],JSON_THROW_ON_ERROR)]);
            foreach([['food',-$foodUse],['water',-$waterUse],['population',$populationAfter-(int)$c['population']]] as [$key,$amount]){$this->pdo->prepare('INSERT INTO resource_transactions(player_id,colony_id,resource_key,amount,reason,metadata) VALUES(?,?,?,?,?,?)')->execute([$playerId,$colonyId,$key,$amount,'colony_settlement',json_encode(['hours'=>$hours,'shortage'=>$shortage],JSON_THROW_ON_ERROR)]);}
            $this->pdo->commit();return ['colony_id'=>$colonyId,'food_before'=>$food,'food_after'=>$foodAfter,'water_before'=>$water,'water_after'=>$waterAfter,'population_before'=>(int)$c['population'],'population_after'=>$populationAfter,'growth'=>$populationAfter-(int)$c['population'],'shortage'=>$shortage,'morale'=>$morale];
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
