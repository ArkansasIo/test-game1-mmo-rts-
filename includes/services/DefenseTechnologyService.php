<?php
declare(strict_types=1);

final class DefenseTechnologyService
{
    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        $sql = "SELECT t.id,t.technology_key,t.name,t.category,t.base_cost,t.cost_growth,t.effect_value,t.description,COALESCE(pt.level,0) current_level,COALESCE(pt.next_cost,t.base_cost) stored_next_cost, GROUP_CONCAT(CONCAT(req.name,'|',pr.minimum_level,'|',COALESCE(reqpt.level,0)) SEPARATOR ';') prerequisites FROM technologies t LEFT JOIN player_technologies pt ON pt.player_id=? AND pt.technology_key=t.technology_key LEFT JOIN technology_prerequisites pr ON pr.technology_key=t.technology_key LEFT JOIN technologies req ON req.technology_key=pr.prerequisite_key LEFT JOIN player_technologies reqpt ON reqpt.player_id=? AND reqpt.technology_key=req.technology_key WHERE t.category='defense' GROUP BY t.id,t.technology_key,t.name,t.category,t.base_cost,t.cost_growth,t.effect_value,t.description,pt.level,pt.next_cost ORDER BY t.base_cost,t.name";
        $stmt = $this->pdo->prepare($sql); $stmt->execute([$playerId,$playerId]);
        $techs = array_map(function(array $row): array {
            $level=(int)$row['current_level']; $cost=(int)round((float)$row['base_cost']*pow((float)$row['cost_growth'],$level)); $prerequisites=[]; foreach(array_filter(explode(';',(string)($row['prerequisites']??''))) as $item){[$name,$required,$owned]=array_pad(explode('|',$item),3,'0');$prerequisites[]=['name'=>$name,'required_level'=>(int)$required,'current_level'=>(int)$owned,'met'=>(int)$owned>=(int)$required];} $locked=count(array_filter($prerequisites,fn($p)=>!$p['met']))>0; return ['id'=>(int)$row['id'],'technology_key'=>$row['technology_key'],'name'=>$row['name'],'category'=>$row['category'],'description'=>$row['description'],'current_level'=>$level,'next_level'=>$level+1,'base_cost'=>(int)$row['base_cost'],'next_cost'=>$cost,'effect_value'=>(float)$row['effect_value'],'effect_preview'=>round((float)$row['effect_value']*($level+1),2),'prerequisites'=>$prerequisites,'locked'=>$locked]; }, $stmt->fetchAll());
        $q=$this->pdo->prepare("SELECT id,item_key,level_before,starts_at,completes_at,status FROM construction_queue WHERE player_id=? AND queue_type='research' AND status IN ('queued','processing') ORDER BY completes_at LIMIT 10");$q->execute([$playerId]);$queue=$q->fetchAll();
        return ['branch'=>'defense','technology_formula'=>'defense effect = base defense × technology level × tier coefficient','technologies'=>$techs,'queue'=>$queue,'queue_available'=>count($queue)===0,'states'=>['ready','locked','insufficient-resource','success','error']];
    }

    public function upgrade(int $playerId,string $technologyKey): array
    {
        $this->pdo->beginTransaction();
        try {
            $s=$this->pdo->prepare("SELECT * FROM technologies WHERE technology_key=? AND category='defense' FOR UPDATE");$s->execute([$technologyKey]);$tech=$s->fetch();if(!$tech)throw new RuntimeException('Defense technology not found.');
            $s=$this->pdo->prepare('SELECT * FROM player_technologies WHERE player_id=? AND technology_key=? FOR UPDATE');$s->execute([$playerId,$technologyKey]);$owned=$s->fetch();$level=(int)($owned['level']??0);
            $s=$this->pdo->prepare("SELECT COUNT(*) FROM construction_queue WHERE player_id=? AND queue_type='research' AND status IN ('queued','processing')");$s->execute([$playerId]);if((int)$s->fetchColumn()>0)throw new RuntimeException('Research queue is occupied.');
            $s=$this->pdo->prepare("SELECT req.name,pr.minimum_level required_level,COALESCE(reqpt.level,0) current_level FROM technology_prerequisites pr JOIN technologies req ON req.technology_key=pr.prerequisite_key JOIN technologies target ON target.technology_key=pr.technology_key LEFT JOIN player_technologies reqpt ON reqpt.player_id=? AND reqpt.technology_key=req.technology_key WHERE target.id=?");$s->execute([$playerId,$tech['id']]);foreach($s->fetchAll() as $req)if((int)$req['current_level']<(int)$req['required_level'])throw new RuntimeException('Prerequisite not met: '.$req['name'].' level '.$req['required_level'].'.');
            $cost=(int)round((float)$tech['base_cost']*pow((float)$tech['cost_growth'],$level));$s=$this->pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=? FOR UPDATE');$s->execute([$playerId]);if((int)$s->fetchColumn()<$cost)throw new RuntimeException('Not enough Naquadah for defense research.');
            $seconds=300+($level*120);$start=new DateTimeImmutable('now');$complete=$start->modify('+'.$seconds.' seconds');$this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah-? WHERE player_id=?')->execute([$cost,$playerId]);$this->pdo->prepare("INSERT INTO construction_queue(player_id,colony_id,queue_type,item_key,quantity,level_before,starts_at,completes_at,status) VALUES(?,NULL,'research',?,1,?,?,?,'queued')")->execute([$playerId,$technologyKey,$level,$start->format('Y-m-d H:i:s'),$complete->format('Y-m-d H:i:s')]);$id=(int)$this->pdo->lastInsertId();$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)')->execute([$playerId,'defense_research_queued','technology',$tech['id'],json_encode(['queue_id'=>$id,'technology_key'=>$technologyKey,'level_before'=>$level,'cost'=>$cost,'completes_at'=>$complete->format('Y-m-d H:i:s')],JSON_THROW_ON_ERROR)]);$this->pdo->commit();return ['queue_id'=>$id,'cost'=>$cost,'level_before'=>$level,'level_after'=>$level+1,'completes_at'=>$complete->format('Y-m-d H:i:s')];
        }catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
