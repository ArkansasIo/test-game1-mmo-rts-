<?php
declare(strict_types=1);

final class OffenseTechnologyService
{
    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        $tree=new TechnologyTreeService($this->pdo);$state=$tree->snapshot($playerId);$state['technologies']=array_values(array_filter($state['technologies'],fn(array $t): bool=>$t['category']==='offense'));$state['branch_systems']=array_values(array_filter($state['branch_systems']??[],fn(array $t): bool=>$t['category']==='offense'));$state['branch']='offense';$state['formula']='offense effect = base damage × technology level × tier coefficient';$state['weapon_systems']=$this->weaponSystems($playerId);$state['damage_modifier']=round(array_sum(array_map(fn(array $t): float=>(float)$t['current_effect'],$state['technologies'])),2);$state['next_damage_modifier']=round(array_sum(array_map(fn(array $t): float=>(float)$t['next_effect'],$state['technologies'])),2);return $state;
    }

    private function weaponSystems(int $playerId): array
    {
        $q=$this->pdo->prepare("SELECT wt.id,wt.name,wt.category,wt.power,wt.price,COALESCE(pw.quantity,0) quantity,COALESCE(pw.durability,wt.max_durability) durability,wt.max_durability FROM weapon_types wt LEFT JOIN player_weapons pw ON pw.weapon_type_id=wt.id AND pw.player_id=? WHERE wt.category IN ('attack','super_attack') ORDER BY wt.power DESC,wt.name");$q->execute([$playerId]);$rows=[];foreach($q->fetchAll() as $w){$condition=(int)$w['max_durability']>0?(int)$w['durability']/(int)$w['max_durability']:1;$rows[]=['id'=>(int)$w['id'],'name'=>$w['name'],'category'=>$w['category'],'base_damage'=>(float)$w['power'],'owned'=>(int)$w['quantity'],'condition'=>round($condition*100,1),'effective_damage'=>round((float)$w['power']*$condition,2),'price'=>(int)$w['price']];}return $rows;
    }

    public function upgrade(int $playerId,string $technologyKey): array
    {
        $s=$this->pdo->prepare('SELECT category FROM technologies WHERE technology_key=?');$s->execute([$technologyKey]);if($s->fetchColumn()!=='offense')throw new RuntimeException('Offense technology required.');return (new TechnologyTreeService($this->pdo))->upgrade($playerId,$technologyKey);
    }
}
