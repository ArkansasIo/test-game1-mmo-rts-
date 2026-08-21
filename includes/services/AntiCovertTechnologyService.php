<?php
declare(strict_types=1);

final class AntiCovertTechnologyService
{
    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        $tree=new TechnologyTreeService($this->pdo);$state=$tree->snapshot($playerId);$state['technologies']=array_values(array_filter($state['technologies'],fn(array $t): bool=>$t['category']==='anti_covert'));$state['branch_systems']=array_values(array_filter($state['branch_systems']??[],fn(array $t): bool=>$t['category']==='anti_covert'));$state['branch']='anti_covert';$state['formula']='counter-intelligence = base counter force × technology level × tier coefficient';$q=$this->pdo->prepare('SELECT anti_spies,spies,covert_capacity FROM player_resources WHERE player_id=?');$q->execute([$playerId]);$r=$q->fetch()?:['anti_spies'=>0,'spies'=>0,'covert_capacity'=>0];$state['counter_systems']=[['name'=>'Counter-Spy Agents','role'=>'counter-intelligence','available'=>(int)$r['anti_spies'],'capacity'=>(int)$r['covert_capacity'],'base_counter_force'=>12,'effective_counter_force'=>round((int)$r['anti_spies']*12,2)],['name'=>'Detection Operators','role'=>'signal detection','available'=>(int)$r['spies'],'capacity'=>(int)$r['covert_capacity'],'base_counter_force'=>6,'effective_counter_force'=>round((int)$r['spies']*6,2)]];$state['counter_intelligence']=round(array_sum(array_map(fn(array $t): float=>(float)$t['current_effect'],$state['technologies'])),2);$state['next_counter_intelligence']=round(array_sum(array_map(fn(array $t): float=>(float)$t['next_effect'],$state['technologies'])),2);return $state;
    }

    public function upgrade(int $playerId,string $technologyKey): array
    {
        $s=$this->pdo->prepare('SELECT category FROM technologies WHERE technology_key=?');$s->execute([$technologyKey]);if($s->fetchColumn()!=='anti_covert')throw new RuntimeException('Anti-covert technology required.');return (new TechnologyTreeService($this->pdo))->upgrade($playerId,$technologyKey);
    }
}
