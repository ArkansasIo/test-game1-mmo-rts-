<?php
declare(strict_types=1);
final class PageDataService {
    public function __construct(private PDO $pdo) {}
    public function colonies(int $playerId):array{$s=$this->pdo->prepare('SELECT * FROM colonies WHERE player_id=? ORDER BY is_homeworld DESC,id');$s->execute([$playerId]);return $s->fetchAll();}
    public function colony(int $playerId,int $colonyId):?array{$s=$this->pdo->prepare('SELECT * FROM colonies WHERE player_id=? AND id=?');$s->execute([$playerId,$colonyId]);$r=$s->fetch();return $r?:null;}
    public function balances(int $playerId):array{$s=$this->pdo->prepare('SELECT * FROM player_resource_balances WHERE player_id=? ORDER BY resource_key');$s->execute([$playerId]);return $s->fetchAll();}
    public function queue(int $playerId,?int $colonyId=null):array{$sql='SELECT * FROM construction_queue WHERE player_id=?';$args=[$playerId];if($colonyId!==null){$sql.=' AND colony_id=?';$args[]=$colonyId;}$sql.=' AND status IN (\'queued\',\'processing\') ORDER BY completes_at';$s=$this->pdo->prepare($sql);$s->execute($args);return $s->fetchAll();}
    public function missions(int $playerId):array{$s=$this->pdo->prepare('SELECT fm.*,s.name AS source_name,t.name AS target_name FROM fleet_missions fm JOIN colonies s ON s.id=fm.source_colony_id LEFT JOIN colonies t ON t.id=fm.target_colony_id WHERE fm.player_id=? ORDER BY fm.arrival_at DESC');$s->execute([$playerId]);return $s->fetchAll();}
    public function snapshots(int $playerId,int $colonyId,int $limit=20):array{$this->colony($playerId,$colonyId);$limit=max(1,min(100,$limit));$s=$this->pdo->prepare("SELECT cts.* FROM colony_turn_snapshots cts JOIN colonies c ON c.id=cts.colony_id WHERE c.player_id=? AND cts.colony_id=? ORDER BY cts.processed_at DESC LIMIT {$limit}");$s->execute([$playerId,$colonyId]);return $s->fetchAll();}
    public function eventLog(int $playerId,int $limit=50):array{$limit=max(1,min(200,$limit));$s=$this->pdo->prepare("SELECT * FROM game_events WHERE player_id=? ORDER BY created_at DESC LIMIT {$limit}");$s->execute([$playerId]);return $s->fetchAll();}
}
