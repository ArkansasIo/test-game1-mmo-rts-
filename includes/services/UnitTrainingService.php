<?php
declare(strict_types=1);

final class UnitTrainingService
{
    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        $r=$this->pdo->prepare('SELECT untrained_units,unit_production,miners,lifers,attack_units,defense_units,spies,anti_spies,naquadah,population,workforce FROM player_resources WHERE player_id=?');$r->execute([$playerId]);$resources=$r->fetch()?:[];$a=$this->pdo->prepare('SELECT academy_level FROM player_unit_stats WHERE player_id=?');$a->execute([$playerId]);$academy=(int)($a->fetchColumn()?:1);$u=$this->pdo->query('SELECT * FROM unit_types ORDER BY category,name');$roster=[];foreach($u->fetchAll() as $type){$owned=(int)($resources[$type['stat_column']]??0);$cost=(int)$type['recruit_cost'];$seconds=(int)$type['seconds_per_unit'];$roster[]=['id'=>(int)$type['id'],'unit_key'=>$type['unit_key'],'name'=>$type['name'],'category'=>$type['category'],'stat_column'=>$type['stat_column'],'owned'=>$owned,'recruit_cost'=>$cost,'seconds_per_unit'=>$seconds,'academy_level_required'=>(int)$type['academy_level_required'],'base_power'=>(int)$type['base_power'],'description'=>$type['description'],'ready'=>$academy>=(int)$type['academy_level_required'],'next_batch_cost'=>$cost*10,'next_batch_seconds'=>$seconds*10];}$q=$this->pdo->prepare("SELECT tq.id,ut.name,tq.quantity,tq.academy_level,tq.starts_at,tq.completes_at,tq.status FROM training_queues tq JOIN unit_types ut ON ut.id=tq.unit_type_id WHERE tq.player_id=? AND tq.status IN ('queued','processing') ORDER BY tq.completes_at");$q->execute([$playerId]);$queue=$q->fetchAll();$production=(int)($resources['unit_production']??0);return ['resources'=>$resources,'academy_level'=>$academy,'roster'=>$roster,'queue'=>$queue,'queue_capacity'=>5,'queue_used'=>count($queue),'queue_available'=>count($queue)<5,'untrained_units'=>(int)($resources['untrained_units']??0),'production_level'=>$production,'next_production_cost'=>$production*5000+10000,'formula'=>'training output = queue time × academy level × population workforce','states'=>['ready','empty','insufficient-resource','success','error']];
    }

    public function train(int $playerId,string $unitKey,int $quantity): array
    {
        if($playerId<1)throw new InvalidArgumentException('Invalid commander');
        if($quantity<1||$quantity>10000)throw new InvalidArgumentException('Training quantity must be between 1 and 10,000.');
        if($unitKey==='')throw new InvalidArgumentException('Training type is required.');
        $this->pdo->beginTransaction();
        try {
            $s=$this->pdo->prepare('SELECT * FROM unit_types WHERE unit_key=? FOR UPDATE');$s->execute([$unitKey]);$type=$s->fetch(PDO::FETCH_ASSOC);if(!$type)throw new RuntimeException('Training type not found.');
            $s=$this->pdo->prepare('SELECT * FROM player_resources WHERE player_id=? FOR UPDATE');$s->execute([$playerId]);$r=$s->fetch(PDO::FETCH_ASSOC);if(!$r)throw new RuntimeException('Player resources not found.');
            $cooldownSeconds=(int)($this->pdo->query("SELECT setting_value FROM game_settings WHERE setting_key='training_cooldown_seconds'")->fetchColumn() ?: 0);$cooldownStmt=$this->pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='training' FOR UPDATE");$cooldownStmt->execute([$playerId]);$availableAt=$cooldownStmt->fetchColumn();if($availableAt!==false&&new DateTimeImmutable((string)$availableAt)>new DateTimeImmutable('now'))throw new RuntimeException('Training is on cooldown.');
            $s=$this->pdo->prepare('SELECT academy_level FROM player_unit_stats WHERE player_id=? FOR UPDATE');$s->execute([$playerId]);$academy=(int)($s->fetchColumn()?:1);if($academy<(int)$type['academy_level_required'])throw new RuntimeException('Academy level requirement not met.');
            $s=$this->pdo->prepare("SELECT id FROM training_queues WHERE player_id=? AND status IN ('queued','processing') FOR UPDATE");$s->execute([$playerId]);if(count($s->fetchAll(PDO::FETCH_COLUMN))>=5)throw new RuntimeException('Training queue capacity reached.');
            if((int)$r['untrained_units']<$quantity)throw new RuntimeException('Not enough untrained population.');$cost=(int)$type['recruit_cost']*$quantity;if((int)$r['naquadah']<$cost)throw new RuntimeException('Not enough Naquadah for recruitment.');
            $seconds=(int)$type['seconds_per_unit']*$quantity;$start=new DateTimeImmutable('now');$complete=$start->modify('+'.$seconds.' seconds');$this->pdo->prepare('UPDATE player_resources SET untrained_units=untrained_units-?,naquadah=naquadah-? WHERE player_id=?')->execute([$quantity,$cost,$playerId]);$this->pdo->prepare("INSERT INTO training_queues(player_id,unit_type_id,quantity,academy_level,starts_at,completes_at,status) VALUES(?,?,?,?,?,?, 'queued')")->execute([$playerId,$type['id'],$quantity,$academy,$start->format('Y-m-d H:i:s'),$complete->format('Y-m-d H:i:s')]);$id=(int)$this->pdo->lastInsertId();
            if($cooldownSeconds>0){$next=$start->modify('+'.$cooldownSeconds.' seconds')->format('Y-m-d H:i:s');$this->pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$playerId,'training',$next]);}
            $this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)')->execute([$playerId,'unit_training_queued','training_queue',$id,json_encode(['unit_key'=>$unitKey,'quantity'=>$quantity,'cost'=>$cost,'academy_level'=>$academy,'completes_at'=>$complete->format('Y-m-d H:i:s'),'cooldown_seconds'=>$cooldownSeconds],JSON_THROW_ON_ERROR)]);$this->pdo->commit();return ['queue_id'=>$id,'unit_key'=>$unitKey,'quantity'=>$quantity,'cost'=>$cost,'completes_at'=>$complete->format('Y-m-d H:i:s'),'cooldown_seconds'=>$cooldownSeconds];
        }catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }

    public function upgradeProduction(int $playerId): int
    {
        $this->pdo->beginTransaction();try{$s=$this->pdo->prepare('SELECT unit_production,naquadah FROM player_resources WHERE player_id=? FOR UPDATE');$s->execute([$playerId]);$r=$s->fetch();if(!$r)throw new RuntimeException('Player resources not found.');$cost=(int)$r['unit_production']*5000+10000;if((int)$r['naquadah']<$cost)throw new RuntimeException('Not enough Naquadah for production upgrade.');$this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah-?,unit_production=unit_production+1 WHERE player_id=?')->execute([$cost,$playerId]);$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)')->execute([$playerId,'unit_production_upgraded','player_resources',$playerId,json_encode(['cost'=>$cost,'level_before'=>(int)$r['unit_production']],JSON_THROW_ON_ERROR)]);$this->pdo->commit();return $cost;}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
