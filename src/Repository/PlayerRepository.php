<?php
declare(strict_types=1);
namespace SGW\Repository;
use PDO;
final class PlayerRepository {
    public function __construct(private PDO $db){}
    public function find(int $id):?array{$s=$this->db->prepare('SELECT p.*,r.name AS race FROM players p JOIN races r ON r.id=p.race_id WHERE p.id=?');$s->execute([$id]);return $s->fetch()?:null;}
    public function findByUsername(string $username):?array{$s=$this->db->prepare('SELECT p.*,r.name AS race FROM players p JOIN races r ON r.id=p.race_id WHERE p.username=?');$s->execute([$username]);return $s->fetch()?:null;}
    public function create(string $username,string $passwordHash,int $raceId):int{$this->db->beginTransaction();try{$s=$this->db->prepare('INSERT INTO players(username,display_name,password_hash,race_id,last_turn_at) VALUES(?,?,?,?,NOW())');$s->execute([$username,$username,$passwordHash,$raceId]);$id=(int)$this->db->lastInsertId();foreach(['player_resources','player_unit_stats','motherships','protection_states','vacation_states','ascension_states','rankings','glory_reputation','supporter_status'] as $table){$sql=$table==='motherships'?"INSERT INTO {$table}(player_id,name) VALUES(?,?)":"INSERT INTO {$table}(player_id) VALUES(?)";$this->db->prepare($sql)->execute($table==='motherships'?[$id,$username.' Mothership']:[$id]);}$this->db->commit();return $id;}catch(\Throwable $e){$this->db->rollBack();throw $e;}}
}
