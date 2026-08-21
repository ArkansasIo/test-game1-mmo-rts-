<?php
declare(strict_types=1);

final class CovertTechnologyService
{
    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        $tree=new TechnologyTreeService($this->pdo);$state=$tree->snapshot($playerId);$state['technologies']=array_values(array_filter($state['technologies'],fn(array $t): bool=>$t['category']==='covert'));$state['branch_systems']=array_values(array_filter($state['branch_systems']??[],fn(array $t): bool=>$t['category']==='covert'));$state['branch']='covert';$state['formula']='covert effect = agent effectiveness × technology level × tier coefficient';$q=$this->pdo->prepare('SELECT spies,anti_spies,covert_capacity FROM player_resources WHERE player_id=?');$q->execute([$playerId]);$r=$q->fetch()?:['spies'=>0,'anti_spies'=>0,'covert_capacity'=>0];$state['agent_systems']=[['name'=>'Spy Agents','role'=>'infiltration','available'=>(int)$r['spies'],'capacity'=>(int)$r['covert_capacity'],'base_effectiveness'=>10,'effective_output'=>round((int)$r['spies']*10,2)],['name'=>'Counter-Spy Agents','role'=>'detection support','available'=>(int)$r['anti_spies'],'capacity'=>(int)$r['covert_capacity'],'base_effectiveness'=>8,'effective_output'=>round((int)$r['anti_spies']*8,2)]];$state['infiltration_modifier']=round(array_sum(array_map(fn(array $t): float=>(float)$t['current_effect'],$state['technologies'])),2);$state['next_infiltration_modifier']=round(array_sum(array_map(fn(array $t): float=>(float)$t['next_effect'],$state['technologies'])),2);return $state;
    }

    public function upgrade(int $playerId,string $technologyKey): array
    {
        $s=$this->pdo->prepare('SELECT category FROM technologies WHERE technology_key=?');$s->execute([$technologyKey]);if($s->fetchColumn()!=='covert')throw new RuntimeException('Covert technology required.');return (new TechnologyTreeService($this->pdo))->upgrade($playerId,$technologyKey);
    }
}
