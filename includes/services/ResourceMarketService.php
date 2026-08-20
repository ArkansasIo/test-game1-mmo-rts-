<?php
declare(strict_types=1);

final class ResourceMarketService
{
    public const FEE_RATE = 0.05;
    public const MAX_QUANTITY = 100000000;
    public const MAX_RATE = 1000000;
    public const DEFAULT_EXPIRY_HOURS = 72;
    private const RESOURCES = ['metal','crystal','naquadah','energy','food','water','dark_matter','population'];
    private const RATES = ['metal'=>1.0,'crystal'=>1.25,'naquadah'=>1.0,'energy'=>0.75,'food'=>0.5,'water'=>0.5,'dark_matter'=>10.0,'population'=>0.1];

    public function __construct(private PDO $pdo) {}

    private function resourceColumn(string $resource): string
    {
        if(!in_array($resource,self::RESOURCES,true))throw new InvalidArgumentException('Resource is not tradeable.');
        return $resource;
    }

    private function balance(int $playerId,string $resource,bool $lock=true): int
    {
        $this->resourceColumn($resource);
        if($resource==='naquadah'){$s=$this->pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=?'.($lock?' FOR UPDATE':''));$s->execute([$playerId]);$value=$s->fetchColumn();if($value===false)throw new RuntimeException('Player resources not found.');return (int)$value;}
        $s=$this->pdo->prepare('SELECT amount FROM player_resource_balances WHERE player_id=? AND resource_key=?'.($lock?' FOR UPDATE':''));$s->execute([$playerId,$resource]);$value=$s->fetchColumn();if($value===false)throw new RuntimeException('Resource balance not found.');return (int)$value;
    }

    private function adjust(int $playerId,string $resource,int $delta): void
    {
        $this->resourceColumn($resource);
        if($resource==='naquadah'){$this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah+? WHERE player_id=?')->execute([$delta,$playerId]);return;}
        $this->pdo->prepare('UPDATE player_resource_balances SET amount=amount+? WHERE player_id=? AND resource_key=?')->execute([$delta,$playerId,$resource]);
    }

    private function setting(string $key,int $default=0): int
    {
        $s=$this->pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');$s->execute([$key]);$value=$s->fetchColumn();return $value===false?$default:max(0,(int)$value);
    }

    private function event(int $playerId,string $type,array $payload): void
    {
        $s=$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)');$s->execute([$playerId,$type,'market_order',null,json_encode($payload,JSON_THROW_ON_ERROR)]);
    }

    public function snapshot(int $playerId): array
    {
        if($playerId<1)throw new InvalidArgumentException('Invalid resource market request.');
        $orders=$this->pdo->query("SELECT mo.id,mo.seller_id,mo.resource_type,mo.quantity,mo.unit_price,mo.status,mo.created_at,mo.expires_at,COALESCE(p.display_name,p.username) seller_name FROM market_orders mo JOIN players p ON p.id=mo.seller_id WHERE mo.weapon_type_id IS NULL AND mo.status='open' AND (mo.expires_at IS NULL OR mo.expires_at>NOW()) ORDER BY mo.resource_type,mo.unit_price,mo.created_at")->fetchAll(PDO::FETCH_ASSOC);
        $own=$this->pdo->prepare("SELECT id,resource_type,quantity,unit_price,status,created_at,expires_at FROM market_orders WHERE seller_id=? AND weapon_type_id IS NULL AND status='open' ORDER BY created_at DESC");$own->execute([$playerId]);
        $history=$this->pdo->prepare("SELECT id,order_id,resource_type,quantity,offered_amount,settled_amount,exchange_rate,market_fee,gross_amount,fee_amount,seller_net,created_at FROM market_transactions WHERE resource_type IS NOT NULL AND (seller_id=? OR buyer_id=?) ORDER BY created_at DESC LIMIT 25");$history->execute([$playerId,$playerId]);
        return ['orders'=>$orders,'own_orders'=>$own->fetchAll(PDO::FETCH_ASSOC),'history'=>$history->fetchAll(PDO::FETCH_ASSOC),'rates'=>self::RATES,'fee_rate'=>self::FEE_RATE,'fee_percent'=>self::FEE_RATE*100,'max_quantity'=>self::MAX_QUANTITY,'max_rate'=>self::MAX_RATE,'formula'=>'exchange result = offered resource × rate − market fee','states'=>['ready','empty','insufficient-resource','success','error']];
    }

    public function listOrder(int $sellerId,string $resourceType,int $quantity,int $unitPrice,?int $expiryHours=null): int
    {
        if($sellerId<1)throw new InvalidArgumentException('Invalid seller.');$this->resourceColumn($resourceType);if($quantity<1||$quantity>self::MAX_QUANTITY)throw new InvalidArgumentException('Invalid resource quantity.');if($unitPrice<1||$unitPrice>self::MAX_RATE)throw new InvalidArgumentException('Invalid exchange rate.');$expiryHours=max(1,min(168,$expiryHours??self::DEFAULT_EXPIRY_HOURS));
        $this->pdo->beginTransaction();try{$cooldown=$this->setting('resource_market_cooldown_seconds');$c=$this->pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='resource_market_list' FOR UPDATE");$c->execute([$sellerId]);$available=$c->fetchColumn();if($available!==false&&new DateTimeImmutable((string)$available)>new DateTimeImmutable('now'))throw new RuntimeException('Resource market listing is on cooldown.');$balance=$this->balance($sellerId,$resourceType,true);if($balance<$quantity)throw new RuntimeException('Not enough resource for market escrow.');$this->adjust($sellerId,$resourceType,-$quantity);$expires=(new DateTimeImmutable('now'))->modify('+'.$expiryHours.' hours')->format('Y-m-d H:i:s');$s=$this->pdo->prepare("INSERT INTO market_orders(seller_id,resource_type,weapon_type_id,quantity,unit_price,status,expires_at) VALUES(?,?,NULL,?,?, 'open',?)");$s->execute([$sellerId,$resourceType,$quantity,$unitPrice,$expires]);$id=(int)$this->pdo->lastInsertId();if($cooldown>0){$next=(new DateTimeImmutable('now'))->modify('+'.$cooldown.' seconds')->format('Y-m-d H:i:s');$this->pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$sellerId,'resource_market_list',$next]);}$this->event($sellerId,'resource_market_listed',['order_id'=>$id,'resource_type'=>$resourceType,'quantity'=>$quantity,'unit_price'=>$unitPrice,'expires_at'=>$expires]);$this->pdo->commit();return $id;}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }

    public function buyOrder(int $buyerId,int $orderId,int $quantity): array
    {
        if($buyerId<1||$orderId<1)throw new InvalidArgumentException('Invalid resource market purchase.');if($quantity<1||$quantity>self::MAX_QUANTITY)throw new InvalidArgumentException('Invalid purchase quantity.');
        $this->pdo->beginTransaction();try{$cooldown=$this->setting('resource_market_cooldown_seconds');$c=$this->pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='resource_market_buy' FOR UPDATE");$c->execute([$buyerId]);$available=$c->fetchColumn();if($available!==false&&new DateTimeImmutable((string)$available)>new DateTimeImmutable('now'))throw new RuntimeException('Resource market purchase is on cooldown.');$s=$this->pdo->prepare("SELECT mo.*,COALESCE(p.display_name,p.username) seller_name FROM market_orders mo JOIN players p ON p.id=mo.seller_id WHERE mo.id=? AND mo.weapon_type_id IS NULL AND mo.status='open' FOR UPDATE");$s->execute([$orderId]);$order=$s->fetch(PDO::FETCH_ASSOC);if(!$order||($order['expires_at']&&strtotime($order['expires_at'])<=time()))throw new RuntimeException('Resource market order is unavailable or expired.');if((int)$order['seller_id']===$buyerId)throw new RuntimeException('Cannot buy your own resource order.');if($quantity>(int)$order['quantity'])throw new RuntimeException('Requested quantity exceeds the open order.');$resource=(string)$order['resource_type'];$gross=$quantity*(int)$order['unit_price'];$fee=(int)ceil($gross*self::FEE_RATE);$sellerNet=$gross-$fee;$buyerSettlement=$this->balance($buyerId,'naquadah',true);if($buyerSettlement<$gross)throw new RuntimeException('Not enough Naquadah for settlement.');$this->adjust($buyerId,'naquadah',-$gross);$this->adjust((int)$order['seller_id'],'naquadah',$sellerNet);$this->adjust($buyerId,$resource,$quantity);$remaining=(int)$order['quantity']-$quantity;$this->pdo->prepare("UPDATE market_orders SET quantity=?,status=IF(?=0,'filled','open') WHERE id=?")->execute([$remaining,$remaining,$orderId]);$this->pdo->prepare('INSERT INTO market_transactions(order_id,weapon_type_id,resource_type,seller_id,buyer_id,quantity,offered_amount,unit_price,gross_amount,fee_amount,seller_net,settled_amount,exchange_rate,market_fee) VALUES(?,NULL,?,?,?,?,?,?,?,?,?,?,?,?)')->execute([$orderId,$resource,$order['seller_id'],$buyerId,$quantity,$quantity,$order['unit_price'],$gross,$fee,$sellerNet,$quantity,$order['unit_price'],$fee]);$tx=(int)$this->pdo->lastInsertId();if($cooldown>0){$next=(new DateTimeImmutable('now'))->modify('+'.$cooldown.' seconds')->format('Y-m-d H:i:s');$this->pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$buyerId,'resource_market_buy',$next]);}$this->event($buyerId,'resource_market_bought',['order_id'=>$orderId,'transaction_id'=>$tx,'resource_type'=>$resource,'quantity'=>$quantity,'gross_amount'=>$gross,'fee_amount'=>$fee,'seller_net'=>$sellerNet]);$this->pdo->commit();return ['transaction_id'=>$tx,'resource_type'=>$resource,'quantity'=>$quantity,'gross_amount'=>$gross,'fee_amount'=>$fee,'seller_net'=>$sellerNet,'exchange_rate'=>(int)$order['unit_price']];}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
