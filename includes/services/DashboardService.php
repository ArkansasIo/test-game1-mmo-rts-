<?php
declare(strict_types=1);
final class DashboardService {
    public function __construct(private PDO $pdo) {}
    private function rows(string $sql, array $params = []): array {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
    private function one(string $sql, array $params = []): array {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
    public function snapshot(int $playerId): array {
        $resources = $this->one('SELECT * FROM player_resources WHERE player_id=?', [$playerId]);
        $colonies = $this->rows('SELECT pc.*,up.name AS planet_name,up.coordinate_label,up.habitability,up.food_modifier,up.water_modifier FROM player_colonies pc JOIN universe_planets up ON up.id=pc.planet_id WHERE pc.player_id=? ORDER BY pc.is_homeworld DESC,pc.id', [$playerId]);
        $queues = $this->rows("SELECT id,queue_type,item_key,quantity,level_before,starts_at,completes_at,status FROM construction_queue WHERE player_id=? AND status IN ('queued','processing') ORDER BY completes_at LIMIT 12", [$playerId]);
        $missions = $this->rows("SELECT id,mission_type,source_colony_id,target_colony_id,departure_at,arrival_at,return_at,status FROM fleet_missions WHERE player_id=? AND status IN ('scheduled','outbound','returning') ORDER BY arrival_at LIMIT 12", [$playerId]);
        $alerts = $this->rows('SELECT id,event_type,payload,created_at FROM game_events WHERE player_id=? ORDER BY created_at DESC LIMIT 8', [$playerId]);
        return ['resources'=>$resources,'colonies'=>$colonies,'queues'=>$queues,'missions'=>$missions,'alerts'=>$alerts];
    }
    public function assertPlayerCanProcessTurns(int $playerId): void {
        if ($playerId < 1) throw new InvalidArgumentException('Invalid player');
        $stmt = $this->pdo->prepare('SELECT id FROM players WHERE id=? FOR UPDATE');
        $stmt->execute([$playerId]);
        if (!$stmt->fetchColumn()) throw new RuntimeException('Player not found');
    }
}
