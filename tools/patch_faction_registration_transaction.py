from pathlib import Path
path = Path('/home/ubuntu/stargatewars/includes/services/FactionService.php')
text = path.read_text()
start = text.index('    public function selectRegistration')
end = text.index('    public function changeRace', start)
replacement = '''    public function selectRegistration(int $playerId, int $raceId, int $governmentId): array
    {
        if ($playerId < 1 || $raceId < 1 || $governmentId < 1) {
            throw new InvalidArgumentException('Invalid faction selection.');
        }
        $ownsTransaction = !$this->pdo->inTransaction();
        if ($ownsTransaction) {
            $this->pdo->beginTransaction();
        }
        try {
            $r = $this->pdo->prepare('SELECT id,name FROM races WHERE id=?');
            $r->execute([$raceId]);
            $race = $r->fetch(PDO::FETCH_ASSOC);
            if (!$race) {
                throw new RuntimeException('Race unavailable.');
            }
            $g = $this->pdo->prepare('SELECT id,name FROM government_types WHERE id=? AND is_active=1');
            $g->execute([$governmentId]);
            $gov = $g->fetch(PDO::FETCH_ASSOC);
            if (!$gov) {
                throw new RuntimeException('Government unavailable.');
            }
            $p = $this->pdo->prepare('SELECT race_id,government_id,registration_completed_at FROM players WHERE id=? FOR UPDATE');
            $p->execute([$playerId]);
            $player = $p->fetch(PDO::FETCH_ASSOC);
            if (!$player) {
                throw new RuntimeException('Player not found.');
            }
            if ($player['registration_completed_at'] !== null && ((int)$player['race_id'] !== $raceId || (int)$player['government_id'] !== $governmentId)) {
                throw new RuntimeException('Registration is complete; use race change or government reform.');
            }
            $this->pdo->prepare('UPDATE players SET race_id=?,government_id=?,registration_completed_at=COALESCE(registration_completed_at,NOW()) WHERE id=?')->execute([$raceId,$governmentId,$playerId]);
            $this->pdo->prepare("INSERT INTO player_government_history(player_id,government_id,reason) VALUES(?,?, 'registration')")->execute([$playerId,$governmentId]);
            $this->event($playerId, 'faction_selected', ['race_id'=>$raceId, 'government_id'=>$governmentId]);
            if ($ownsTransaction) {
                $this->pdo->commit();
            }
            return ['state'=>'success','race_id'=>$raceId,'government_id'=>$governmentId,'race'=>$race['name'],'government'=>$gov['name']];
        } catch (Throwable $e) {
            if ($ownsTransaction && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }
'''
path.write_text(text[:start] + replacement + text[end:])
print('patched faction registration transaction ownership')
