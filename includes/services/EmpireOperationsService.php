<?php
declare(strict_types=1);

final class EmpireOperationsService
{
    public function __construct(private PDO $pdo) {}

    private function event(int $playerId,string $type,?int $entityId,array $payload=[]): void
    {
        $s=$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)');
        $s->execute([$playerId,$type,'empire_operation',$entityId,json_encode($payload,JSON_THROW_ON_ERROR)]);
    }

    private function reward(int $playerId,array $reward): void
    {
        $resourceKeys=['metal','crystal','naquadah','energy','dark_matter','food','water','population'];
        $updates=[];$values=[];
        foreach($resourceKeys as $key){if(isset($reward[$key])){$updates[]="`$key`=GREATEST(0,`$key`+?)";$values[]=(int)$reward[$key];}}
        if($updates){$values[]=$playerId;$this->pdo->prepare('UPDATE player_resources SET '.implode(',', $updates).' WHERE player_id=?')->execute($values);}
        if(isset($reward['glory'])){$this->pdo->prepare('UPDATE players SET glory=GREATEST(0,glory+?) WHERE id=?')->execute([(int)$reward['glory'],$playerId]);}
        if(isset($reward['reputation'])){$this->pdo->prepare('UPDATE players SET reputation=reputation+? WHERE id=?')->execute([(int)$reward['reputation'],$playerId]);}
    }

    public function snapshot(int $playerId): array
    {
        if($playerId<1)throw new InvalidArgumentException('Invalid empire request.');
        $missions=$this->pdo->prepare('SELECT id,source_colony_id,target_colony_id,mission_type,payload,departure_at,arrival_at,status FROM fleet_missions WHERE player_id=? ORDER BY created_at DESC LIMIT 25');$missions->execute([$playerId]);
        $reports=$this->pdo->prepare('SELECT id,mission_id,coordinate,outcome,reward_payload,risk_score,resolved_at FROM expedition_reports WHERE player_id=? ORDER BY resolved_at DESC LIMIT 25');$reports->execute([$playerId]);
        $quests=$this->pdo->query('SELECT q.id,q.quest_key,q.category,q.title,q.description,q.objective_key,q.objective_target,q.reward_payload,COALESCE(pq.progress,0) progress,COALESCE(pq.state,\'available\') state FROM quest_definitions q LEFT JOIN player_quests pq ON pq.quest_id=q.id AND pq.player_id='.(int)$playerId.' WHERE q.is_active=1 ORDER BY q.category,q.id')->fetchAll(PDO::FETCH_ASSOC);
        $achievements=$this->pdo->query('SELECT a.id,a.achievement_key,a.title,a.description,a.metric_key,a.metric_target,COALESCE(pa.progress,0) progress,pa.unlocked_at,pa.claimed_at FROM achievement_definitions a LEFT JOIN player_achievements pa ON pa.achievement_id=a.id AND pa.player_id='.(int)$playerId.' WHERE a.is_active=1 ORDER BY a.id')->fetchAll(PDO::FETCH_ASSOC);
        $notifications=$this->pdo->prepare('SELECT id,notification_type,title,body,is_read,created_at FROM player_notifications WHERE player_id=? ORDER BY created_at DESC LIMIT 25');$notifications->execute([$playerId]);
        $officers=$this->pdo->prepare('SELECT o.officer_key,o.display_name,o.effect_key,o.effect_value,po.level,po.expires_at FROM player_officers po JOIN officer_types o ON o.id=po.officer_type_id WHERE po.player_id=? AND o.is_active=1 ORDER BY o.id');$officers->execute([$playerId]);
        return ['state'=>($quests||$achievements||$notifications->rowCount())?'ready':'empty','missions'=>$missions->fetchAll(PDO::FETCH_ASSOC),'expeditions'=>$reports->fetchAll(PDO::FETCH_ASSOC),'quests'=>$quests,'achievements'=>$achievements,'notifications'=>$notifications->fetchAll(PDO::FETCH_ASSOC),'officers'=>$officers->fetchAll(PDO::FETCH_ASSOC),'states'=>['ready','empty','protected','success','error']];
    }

    public function resolveExpedition(int $playerId,int $missionId): array
    {
        if($playerId<1||$missionId<1)throw new InvalidArgumentException('Invalid expedition request.');
        $this->pdo->beginTransaction();
        try{
            $s=$this->pdo->prepare("SELECT id,mission_type,payload,arrival_at,status FROM fleet_missions WHERE id=? AND player_id=? FOR UPDATE");$s->execute([$missionId,$playerId]);$m=$s->fetch(PDO::FETCH_ASSOC);if(!$m)throw new RuntimeException('Mission not found.');
            if($m['mission_type']!=='explore')throw new RuntimeException('Mission is not an expedition.');
            if(!in_array($m['status'],['outbound','arrived'],true))throw new RuntimeException('Expedition is not ready to resolve.');
            if(new DateTimeImmutable((string)$m['arrival_at'])>new DateTimeImmutable('now'))throw new RuntimeException('Expedition is still travelling.');
            $payload=json_decode((string)$m['payload'],true)?:[];$seed=hash('sha256',$playerId.':'.$missionId.':'.($payload['coordinate']??'unknown'));$roll=hexdec(substr($seed,0,4))%100;
            $outcome=$roll<12?'negative':($roll<32?'neutral':($roll<82?'positive':'discovery'));$reward=$outcome==='positive'?['naquadah'=>5000,'dark_matter'=>10,'glory'=>5]:($outcome==='discovery'?['research_data'=>25,'glory'=>15]:[]);$coordinate=(string)($payload['coordinate']??'unknown');
            $this->pdo->prepare("UPDATE fleet_missions SET status='completed',return_at=NOW() WHERE id=?")->execute([$missionId]);$this->pdo->prepare('INSERT INTO expedition_reports(player_id,mission_id,coordinate,outcome,reward_payload,risk_score) VALUES(?,?,?,?,?,?)')->execute([$playerId,$missionId,$coordinate,$outcome,json_encode($reward,JSON_THROW_ON_ERROR),$roll]);$reportId=(int)$this->pdo->lastInsertId();$this->reward($playerId,$reward);$this->event($playerId,'expedition_resolved',$reportId,['mission_id'=>$missionId,'outcome'=>$outcome,'reward'=>$reward]);$this->pdo->commit();return ['state'=>'success','report_id'=>$reportId,'outcome'=>$outcome,'reward'=>$reward];
        }catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }

    public function startQuest(int $playerId,int $questId): array
    {
        if($playerId<1||$questId<1)throw new InvalidArgumentException('Invalid quest request.');
        $this->pdo->prepare("INSERT INTO player_quests(player_id,quest_id,state,started_at) VALUES(?,?, 'active', NOW()) ON DUPLICATE KEY UPDATE state=IF(state='available','active',state),started_at=IF(started_at IS NULL,NOW(),started_at)")->execute([$playerId,$questId]);
        return ['state'=>'success','quest_id'=>$questId,'status'=>'active'];
    }

    public function claimQuest(int $playerId,int $questId): array
    {
        $this->pdo->beginTransaction();try{$s=$this->pdo->prepare('SELECT q.title,q.objective_target,q.reward_payload,pq.progress,pq.state FROM player_quests pq JOIN quest_definitions q ON q.id=pq.quest_id WHERE pq.player_id=? AND pq.quest_id=? FOR UPDATE');$s->execute([$playerId,$questId]);$q=$s->fetch(PDO::FETCH_ASSOC);if(!$q)throw new RuntimeException('Quest is not active.');if((int)$q['progress']<(int)$q['objective_target']||$q['state']!=='completed')throw new RuntimeException('Quest objective is incomplete.');$reward=json_decode((string)$q['reward_payload'],true)?:[];$this->reward($playerId,$reward);$this->pdo->prepare("UPDATE player_quests SET state='claimed',claimed_at=NOW() WHERE player_id=? AND quest_id=?")->execute([$playerId,$questId]);$this->event($playerId,'quest_claimed',$questId,['title'=>$q['title'],'reward'=>$reward]);$this->pdo->commit();return ['state'=>'success','quest_id'=>$questId,'reward'=>$reward];}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }

    public function markNotificationRead(int $playerId,int $notificationId): void
    {
        if($playerId<1||$notificationId<1)throw new InvalidArgumentException('Invalid notification request.');$s=$this->pdo->prepare('UPDATE player_notifications SET is_read=1 WHERE id=? AND player_id=?');$s->execute([$notificationId,$playerId]);if($s->rowCount()<1)throw new RuntimeException('Notification not found.');
    }
}
