<?php
declare(strict_types=1);
final class GameFeatureService {
    public function __construct(private PDO $pdo) {}
    private function audit(int $playerId,string $action,?string $entityType,?int $entityId,array $payload=[]):void {
        $this->pdo->prepare('INSERT INTO game_audit_log(player_id,action_name,entity_type,entity_id,request_id,payload) VALUES(?,?,?,?,UUID(),?)')->execute([$playerId,$action,$entityType,$entityId,json_encode($payload,JSON_THROW_ON_ERROR)]);
    }
    public function queueResearch(int $playerId,int $colonyId,string $technologyKey,int $level,int $seconds):int {
        if ($level<1||$seconds<1||$technologyKey==='') throw new InvalidArgumentException('Invalid research request');
        $this->pdo->beginTransaction();
        try {
            $owner=$this->pdo->prepare('SELECT id FROM colonies WHERE id=? AND player_id=? FOR UPDATE');
            $owner->execute([$colonyId,$playerId]);
            if (!$owner->fetchColumn()) throw new RuntimeException('Colony not owned');
            $this->pdo->prepare("INSERT INTO construction_queue(player_id,colony_id,queue_type,item_key,quantity,level_before,starts_at,completes_at,status) VALUES(?,?, 'research', ?, 1, ?, NOW(), DATE_ADD(NOW(),INTERVAL ? SECOND),'queued')")->execute([$playerId,$colonyId,$technologyKey,$level-1,$seconds]);
            $id=(int)$this->pdo->lastInsertId();
            $this->audit($playerId,'queue_research','construction_queue',$id,['technology_key'=>$technologyKey,'level'=>$level]);
            $this->pdo->commit();
            return $id;
        } catch (Throwable $e) { if($this->pdo->inTransaction())$this->pdo->rollBack(); throw $e; }
    }
    public function joinWorldEvent(int $playerId,int $eventId):void {
        $this->pdo->beginTransaction();
        try {
            $event=$this->pdo->prepare("SELECT id FROM game_world_events WHERE id=? AND status='active' AND starts_at<=NOW() AND ends_at>NOW() FOR UPDATE");
            $event->execute([$eventId]);
            if (!$event->fetchColumn()) throw new RuntimeException('Event unavailable');
            $this->pdo->prepare("INSERT INTO world_event_participants(event_id,player_id) VALUES(?,?) ON DUPLICATE KEY UPDATE participation_state='joined'")->execute([$eventId,$playerId]);
            $this->audit($playerId,'event_join','game_world_events',$eventId);
            $this->pdo->commit();
        } catch (Throwable $e) { if($this->pdo->inTransaction())$this->pdo->rollBack(); throw $e; }
    }
    public function recordDiscovery(int $playerId,string $key,string $type,?int $systemId,?int $planetId,array $payload=[]):int {
        $allowed=['system','planet','moon','anomaly','ruin','resource'];
        if ($key===''||!in_array($type,$allowed,true)) throw new InvalidArgumentException('Invalid discovery');
        $this->pdo->prepare('INSERT INTO universe_discoveries(player_id,solar_system_id,planet_id,discovery_type,discovery_key,payload) VALUES(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE payload=VALUES(payload)')->execute([$playerId,$systemId,$planetId,$type,$key,json_encode($payload,JSON_THROW_ON_ERROR)]);
        $id=(int)$this->pdo->lastInsertId();
        $this->audit($playerId,'record_discovery','universe_discoveries',$id,['discovery_key'=>$key,'discovery_type'=>$type]);
        return $id;
    }
}
