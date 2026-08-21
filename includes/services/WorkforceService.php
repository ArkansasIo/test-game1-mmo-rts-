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

    public function assign(int $playerId, int $colonyId, string $role, int $quantity): array
    {
        if ($playerId < 1 || $colonyId < 1) throw new InvalidArgumentException('Invalid workforce assignment request.');
        if (!in_array($role, ['miners', 'lifers'], true)) throw new InvalidArgumentException('Invalid workforce role.');
        if ($quantity < 0 || $quantity > 1000000000) throw new InvalidArgumentException('Invalid workforce quantity.');
        $this->pdo->beginTransaction();
        try {
            $s = $this->pdo->prepare('SELECT id,population,population_capacity,morale FROM colonies WHERE id=? AND player_id=? FOR UPDATE');
            $s->execute([$colonyId, $playerId]);
            $colony = $s->fetch(PDO::FETCH_ASSOC);
            if (!$colony) throw new RuntimeException('Colony not found or not owned.');
            $s = $this->pdo->prepare("SELECT role,assigned_population FROM population_assignments WHERE colony_id=? FOR UPDATE");
            $s->execute([$colonyId]);
            $assigned = ['miners' => 0, 'lifers' => 0];
            foreach ($s->fetchAll(PDO::FETCH_ASSOC) as $row) $assigned[$row['role']] = (int)$row['assigned_population'];
            $assigned[$role] = $quantity;
            $total = $assigned['miners'] + $assigned['lifers'];
            $population = (int)$colony['population'];
            if ($total > $population) throw new RuntimeException('Workforce assignments exceed colony population.');
            if ($total > (int)$colony['population_capacity']) throw new RuntimeException('Workforce assignments exceed colony capacity.');
            foreach ($assigned as $assignmentRole => $amount) {
                $this->pdo->prepare("INSERT INTO population_assignments (colony_id,role,assigned_population) VALUES (?,?,?) ON DUPLICATE KEY UPDATE assigned_population=VALUES(assigned_population)")->execute([$colonyId, $assignmentRole, $amount]);
            }
            $this->pdo->prepare('UPDATE colonies SET workforce=? WHERE id=?')->execute([$total, $colonyId]);
            $this->pdo->prepare('INSERT INTO game_events (player_id,event_type,entity_type,entity_id,payload) VALUES (?,?,?,?,?)')->execute([$playerId, 'workforce_assigned', 'colony', $colonyId, json_encode(['role'=>$role,'quantity'=>$quantity,'miners'=>$assigned['miners'],'lifers'=>$assigned['lifers']], JSON_THROW_ON_ERROR)]);
            $this->pdo->commit();
            return ['state'=>'success','colony_id'=>$colonyId,'role'=>$role,'quantity'=>$quantity,'miners'=>$assigned['miners'],'lifers'=>$assigned['lifers'],'total_assigned'=>$total,'unassigned_population'=>max(0,$population-$total)];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }
}
