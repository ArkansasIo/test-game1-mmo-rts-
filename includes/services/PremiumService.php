<?php
declare(strict_types=1);
final class PremiumService
{
    public function __construct(private PDO $pdo) {}

    private function ensureWallet(int $playerId): void
    {
        $this->pdo->prepare('INSERT INTO player_premium(player_id) VALUES(?) ON DUPLICATE KEY UPDATE player_id=VALUES(player_id)')->execute([$playerId]);
    }
    private function event(int $playerId, string $type, array $payload): void
    {
        $s=$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)');
        $s->execute([$playerId,$type,'premium',$playerId,json_encode($payload,JSON_THROW_ON_ERROR)]);
    }
    private function catalog(string $key): array
    {
        $s=$this->pdo->prepare('SELECT * FROM premium_catalog WHERE item_key=? AND is_active=1 FOR UPDATE'); $s->execute([$key]);
        $row=$s->fetch(PDO::FETCH_ASSOC); if(!$row) throw new InvalidArgumentException('Premium item is unavailable.'); return $row;
    }
    public function state(int $playerId): array
    {
        $this->ensureWallet($playerId);
        $w=$this->pdo->prepare('SELECT * FROM player_premium WHERE player_id=?'); $w->execute([$playerId]);
        $wallet=$w->fetch(PDO::FETCH_ASSOC) ?: [];
        $catalog=$this->pdo->query('SELECT item_key,category,display_name,description,price_dark_matter,effect_key,effect_value,duration_seconds,max_uses FROM premium_catalog WHERE is_active=1 ORDER BY category,item_key')->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $tx=$this->pdo->prepare('SELECT item_key,transaction_type,price_dark_matter,payload,created_at FROM premium_transactions WHERE player_id=? ORDER BY id DESC LIMIT 12'); $tx->execute([$playerId]);
        return ['wallet'=>$wallet,'catalog'=>$catalog,'transactions'=>$tx->fetchAll(PDO::FETCH_ASSOC) ?: []];
    }
    public function purchase(int $playerId,string $itemKey,int $quantity=1): array
    {
        if($quantity<1 || $quantity>10) throw new InvalidArgumentException('Quantity must be between 1 and 10.');
        $this->pdo->beginTransaction();
        try {
            $this->ensureWallet($playerId); $item=$this->catalog($itemKey);
            if($item['category']==='store' && $item['effect_key']==='dark_matter_grant') { throw new InvalidArgumentException('This grant is not purchasable.'); }
            $cost=(int)$item['price_dark_matter']*$quantity;
            $w=$this->pdo->prepare('SELECT dark_matter FROM player_premium WHERE player_id=? FOR UPDATE'); $w->execute([$playerId]); $balance=(int)$w->fetchColumn();
            if($balance<$cost) throw new RuntimeException('Insufficient Dark Matter balance.');
            $this->pdo->prepare('UPDATE player_premium SET dark_matter=dark_matter-? WHERE player_id=?')->execute([$cost,$playerId]);
            $this->pdo->prepare('INSERT INTO premium_transactions(player_id,item_key,transaction_type,price_dark_matter,payload) VALUES(?,?,?,?,?)')->execute([$playerId,$itemKey,'purchase',$cost,json_encode(['quantity'=>$quantity],JSON_THROW_ON_ERROR)]);
            $this->event($playerId,'premium_purchase',['item_key'=>$itemKey,'quantity'=>$quantity,'cost'=>$cost]); $this->pdo->commit();
            return ['item_key'=>$itemKey,'quantity'=>$quantity,'cost'=>$cost,'balance'=>$balance-$cost];
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
    public function claimDaily(int $playerId): array
    {
        $this->pdo->beginTransaction();
        try {
            $this->ensureWallet($playerId); $s=$this->pdo->prepare('SELECT daily_claim_at FROM player_premium WHERE player_id=? FOR UPDATE');$s->execute([$playerId]);$last=$s->fetchColumn();
            if($last && strtotime((string)$last)>time()-86400) throw new RuntimeException('Daily premium claim is on cooldown.');
            $reward=100; $this->pdo->prepare('UPDATE player_premium SET dark_matter=dark_matter+?, daily_claim_at=NOW() WHERE player_id=?')->execute([$reward,$playerId]);
            $this->pdo->prepare('INSERT INTO premium_transactions(player_id,item_key,transaction_type,price_dark_matter,payload) VALUES(?,?,?,?,?)')->execute([$playerId,'daily_claim','claim',0,json_encode(['reward'=>$reward],JSON_THROW_ON_ERROR)]);
            $this->event($playerId,'premium_daily_claim',['reward'=>$reward]); $this->pdo->commit(); return ['reward'=>$reward];
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
    public function activate(int $playerId,string $itemKey): array
    {
        $this->pdo->beginTransaction();
        try {
            $this->ensureWallet($playerId); $item=$this->catalog($itemKey); if(!in_array($item['category'],['officer','service'],true)) throw new InvalidArgumentException('Only officer and service items can be activated.');
            $w=$this->pdo->prepare('SELECT dark_matter FROM player_premium WHERE player_id=? FOR UPDATE');$w->execute([$playerId]);$balance=(int)$w->fetchColumn();$cost=(int)$item['price_dark_matter'];if($balance<$cost)throw new RuntimeException('Insufficient Dark Matter balance.');
            $expires=$item['duration_seconds']>0?(new DateTimeImmutable('now'))->modify('+'.(int)$item['duration_seconds'].' seconds')->format('Y-m-d H:i:s'):null;
            $this->pdo->prepare('UPDATE player_premium SET dark_matter=dark_matter-?,active_officer_key=?,officer_expires_at=?,service_flags=JSON_SET(COALESCE(service_flags,JSON_OBJECT()),CONCAT("$.",?),COALESCE(JSON_EXTRACT(service_flags,CONCAT("$.",?)),0)+1) WHERE player_id=?')->execute([$cost,$itemKey,$expires,$itemKey,$itemKey,$playerId]);
            $this->pdo->prepare('INSERT INTO premium_transactions(player_id,item_key,transaction_type,price_dark_matter,payload) VALUES(?,?,?,?,?)')->execute([$playerId,$itemKey,'activate',$cost,json_encode(['expires_at'=>$expires,'effect_key'=>$item['effect_key']],JSON_THROW_ON_ERROR)]);
            $this->event($playerId,'premium_activate',['item_key'=>$itemKey,'expires_at'=>$expires]);$this->pdo->commit();return ['item_key'=>$itemKey,'expires_at'=>$expires,'balance'=>$balance-$cost];
        } catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
