<?php
declare(strict_types=1);
final class FactionService {
    public function __construct(private PDO $pdo) {}
    public function options(): array {
        $races=$this->pdo->query('SELECT * FROM races ORDER BY id')->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $governments=$this->pdo->query('SELECT * FROM government_types WHERE is_active=1 ORDER BY id')->fetchAll(PDO::FETCH_ASSOC) ?: [];
        return ['races'=>$races,'governments'=>$governments];
    }
    public function selectRegistration(int $playerId,int $raceId,int $governmentId): void {
        if ($playerId<1||$raceId<1||$governmentId<1) throw new InvalidArgumentException('Invalid faction selection');
        $this->pdo->beginTransaction();
        try {
            $stmt=$this->pdo->prepare('SELECT id FROM races WHERE id=?');$stmt->execute([$raceId]);if(!$stmt->fetchColumn())throw new RuntimeException('Race unavailable');
            $stmt=$this->pdo->prepare('SELECT id FROM government_types WHERE id=? AND is_active=1');$stmt->execute([$governmentId]);if(!$stmt->fetchColumn())throw new RuntimeException('Government unavailable');
            $stmt=$this->pdo->prepare('SELECT id FROM players WHERE id=? FOR UPDATE');$stmt->execute([$playerId]);if(!$stmt->fetchColumn())throw new RuntimeException('Player not found');
            $this->pdo->prepare('UPDATE players SET race_id=?,government_id=?,registration_completed_at=COALESCE(registration_completed_at,NOW()) WHERE id=?')->execute([$raceId,$governmentId,$playerId]);
            $this->pdo->prepare("INSERT INTO player_government_history(player_id,government_id,reason) VALUES(?,?,'registration')")->execute([$playerId,$governmentId]);
            $this->pdo->commit();
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
    public function reformGovernment(int $playerId,int $governmentId): void {
        if ($governmentId<1) throw new InvalidArgumentException('Invalid government');
        $this->pdo->beginTransaction();
        try {
            $stmt=$this->pdo->prepare('SELECT id FROM government_types WHERE id=? AND is_active=1');$stmt->execute([$governmentId]);if(!$stmt->fetchColumn())throw new RuntimeException('Government unavailable');
            $stmt=$this->pdo->prepare('SELECT government_id FROM players WHERE id=? FOR UPDATE');$stmt->execute([$playerId]);if(!$stmt->fetchColumn())throw new RuntimeException('Player not found');
            $this->pdo->prepare('UPDATE players SET government_id=? WHERE id=?')->execute([$governmentId,$playerId]);
            $this->pdo->prepare("INSERT INTO player_government_history(player_id,government_id,reason) VALUES(?,?,'reform')")->execute([$playerId,$governmentId]);
            $this->pdo->commit();
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
    public function bonuses(int $playerId): array {
        $sql='SELECT r.name AS race_name,r.attack_modifier AS race_attack,r.defense_modifier AS race_defense,r.income_modifier AS race_income,r.covert_modifier AS race_covert,g.name AS government_name,g.* FROM players p JOIN races r ON r.id=p.race_id LEFT JOIN government_types g ON g.id=p.government_id WHERE p.id=?';
        $stmt=$this->pdo->prepare($sql);$stmt->execute([$playerId]);$row=$stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        if (!$row) throw new RuntimeException('Player faction state not found');
        return ['race'=>$row['race_name']??null,'government'=>$row['government_name']??null,'attack'=>(float)($row['race_attack']??1)*(float)($row['military_modifier']??1),'defense'=>(float)($row['race_defense']??1)*(float)($row['defense_modifier']??1),'income'=>(float)($row['race_income']??1)*(float)($row['economy_modifier']??1),'research'=>(float)($row['research_modifier']??1),'covert'=>(float)($row['race_covert']??1)*(float)($row['covert_modifier']??1),'diplomacy'=>(float)($row['diplomacy_modifier']??1),'colony'=>(float)($row['colony_modifier']??1),'fleet'=>(float)($row['fleet_modifier']??1),'population'=>(float)($row['population_modifier']??1),'dark_matter'=>(float)($row['dark_matter_modifier']??1)];
    }
}
