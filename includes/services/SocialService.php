<?php
declare(strict_types=1);
final class SocialService {
    public function __construct(private PDO $pdo) {}
    public function blacklist(int $playerId,int $blockedPlayerId,string $reason=''): void {
        if($playerId<1||$blockedPlayerId<1||$playerId===$blockedPlayerId) throw new InvalidArgumentException('Invalid blacklist target');
        $this->pdo->beginTransaction();
        try {
            $s=$this->pdo->prepare('SELECT id FROM players WHERE id=?');$s->execute([$blockedPlayerId]);if(!$s->fetchColumn())throw new RuntimeException('Player not found');
            $this->pdo->prepare('INSERT INTO blacklists(player_id,blocked_player_id,reason) VALUES(?,?,?) ON DUPLICATE KEY UPDATE reason=VALUES(reason)')->execute([$playerId,$blockedPlayerId,mb_substr(trim($reason),0,255)]);
            $this->pdo->commit();
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
