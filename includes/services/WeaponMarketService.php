<?php
declare(strict_types=1);

final class WeaponMarketService
{
    public const FEE_RATE = 0.05;
    public const MIN_UNIT_PRICE = 100;
    public const MAX_UNIT_PRICE = 10000000;
    public const MAX_QUANTITY = 100000;
    public const DEFAULT_EXPIRY_HOURS = 72;

    public function __construct(private PDO $pdo) {}

    private function event(int $playerId, string $type, array $payload): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO game_events (player_id,event_type,entity_type,entity_id,payload) VALUES (?,?,?,?,?)');
        $stmt->execute([$playerId, $type, 'market_order', null, json_encode($payload, JSON_THROW_ON_ERROR)]);
    }

    private function validateOrder(int $quantity, int $unitPrice): void
    {
        if ($quantity < 1 || $quantity > self::MAX_QUANTITY) {
            throw new InvalidArgumentException('Quantity must be between 1 and '.self::MAX_QUANTITY.'.');
        }
        if ($unitPrice < self::MIN_UNIT_PRICE || $unitPrice > self::MAX_UNIT_PRICE) {
            throw new InvalidArgumentException('Unit price must be between '.self::MIN_UNIT_PRICE.' and '.self::MAX_UNIT_PRICE.' Naquadah.');
        }
    }

    public function snapshot(int $playerId): array
    {
        $orders = $this->pdo->query("SELECT mo.id, mo.seller_id, mo.weapon_type_id, mo.quantity, mo.unit_price, mo.status, mo.created_at, mo.expires_at, wt.name, wt.category, wt.power, p.username AS seller_name FROM market_orders mo JOIN weapon_types wt ON wt.id=mo.weapon_type_id JOIN players p ON p.id=mo.seller_id WHERE mo.resource_type='weapon' AND mo.status='open' AND (mo.expires_at IS NULL OR mo.expires_at>NOW()) ORDER BY wt.name, mo.unit_price ASC, mo.created_at ASC")->fetchAll();
        $historyStmt = $this->pdo->prepare("SELECT mt.id, mt.order_id, mt.quantity, mt.unit_price, mt.gross_amount, mt.fee_amount, mt.seller_net, mt.created_at, wt.name, sp.username AS seller_name, bp.username AS buyer_name FROM market_transactions mt JOIN weapon_types wt ON wt.id=mt.weapon_type_id JOIN players sp ON sp.id=mt.seller_id JOIN players bp ON bp.id=mt.buyer_id WHERE mt.seller_id=? OR mt.buyer_id=? ORDER BY mt.created_at DESC LIMIT 25");
        $historyStmt->execute([$playerId, $playerId]);
        $history = $historyStmt->fetchAll();
        $ownStmt = $this->pdo->prepare("SELECT mo.id, mo.weapon_type_id, mo.quantity, mo.unit_price, mo.created_at, mo.expires_at, wt.name FROM market_orders mo JOIN weapon_types wt ON wt.id=mo.weapon_type_id WHERE mo.seller_id=? AND mo.resource_type='weapon' AND mo.status='open' ORDER BY mo.created_at DESC");
        $ownStmt->execute([$playerId]);
        return [
            'orders' => $orders,
            'own_orders' => $ownStmt->fetchAll(),
            'history' => $history,
            'fee_rate' => self::FEE_RATE,
            'fee_percent' => self::FEE_RATE * 100,
            'min_unit_price' => self::MIN_UNIT_PRICE,
            'max_unit_price' => self::MAX_UNIT_PRICE,
            'max_quantity' => self::MAX_QUANTITY,
            'formula' => 'trade settlement = validated order × market price − transaction fee',
            'states' => ['ready','empty','insufficient-resource','success','error'],
        ];
    }

    public function listWeaponOrder(int $sellerId, int $weaponTypeId, int $quantity, int $unitPrice, ?int $expiryHours = null): int
    {
        $this->validateOrder($quantity, $unitPrice);
        $expiryHours = max(1, min(168, $expiryHours ?? self::DEFAULT_EXPIRY_HOURS));
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare('SELECT id, max_durability FROM weapon_types WHERE id=? FOR UPDATE');
            $stmt->execute([$weaponTypeId]);
            if (!$stmt->fetch()) throw new RuntimeException('Weapon type not found.');
            $stmt = $this->pdo->prepare('SELECT id, quantity, durability FROM player_weapons WHERE player_id=? AND weapon_type_id=? FOR UPDATE');
            $stmt->execute([$sellerId, $weaponTypeId]);
            $inventory = $stmt->fetch();
            if (!$inventory || (int)$inventory['quantity'] < $quantity) throw new RuntimeException('Not enough weapons available to list.');
            $expiresAt = (new DateTimeImmutable('now'))->modify('+'.$expiryHours.' hours')->format('Y-m-d H:i:s');
            $this->pdo->prepare('UPDATE player_weapons SET quantity=quantity-? WHERE id=?')->execute([$quantity, $inventory['id']]);
            $this->pdo->prepare("INSERT INTO market_orders (seller_id,resource_type,weapon_type_id,quantity,unit_price,status,expires_at) VALUES (?,'weapon',?,?,?,'open',?)")->execute([$sellerId, $weaponTypeId, $quantity, $unitPrice, $expiresAt]);
            $orderId = (int)$this->pdo->lastInsertId();
            $this->event($sellerId, 'market_weapon_listed', ['order_id'=>$orderId,'weapon_type_id'=>$weaponTypeId,'quantity'=>$quantity,'unit_price'=>$unitPrice,'expires_at'=>$expiresAt]);
            $this->pdo->commit();
            return $orderId;
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function buyWeaponOrder(int $buyerId, int $orderId, int $quantity): array
    {
        if ($quantity < 1 || $quantity > self::MAX_QUANTITY) throw new InvalidArgumentException('Quantity must be positive.');
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("SELECT mo.*, wt.name, wt.max_durability FROM market_orders mo JOIN weapon_types wt ON wt.id=mo.weapon_type_id WHERE mo.id=? AND mo.resource_type='weapon' AND mo.status='open' FOR UPDATE");
            $stmt->execute([$orderId]);
            $order = $stmt->fetch();
            if (!$order || ($order['expires_at'] && strtotime($order['expires_at']) <= time())) throw new RuntimeException('Market order is unavailable or expired.');
            if ((int)$order['seller_id'] === $buyerId) throw new RuntimeException('Cannot buy your own market order.');
            if ($quantity > (int)$order['quantity']) throw new RuntimeException('Requested quantity exceeds the open order.');
            $gross = $quantity * (int)$order['unit_price'];
            $fee = (int)ceil($gross * self::FEE_RATE);
            $sellerNet = $gross - $fee;
            $stmt = $this->pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=? FOR UPDATE');
            $stmt->execute([$buyerId]);
            if ((int)$stmt->fetchColumn() < $gross) throw new RuntimeException('Not enough Naquadah.');
            $this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah-? WHERE player_id=?')->execute([$gross, $buyerId]);
            $this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah+? WHERE player_id=?')->execute([$sellerNet, $order['seller_id']]);
            $this->pdo->prepare('INSERT INTO player_weapons (player_id,weapon_type_id,quantity,durability) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE quantity=quantity+VALUES(quantity),durability=GREATEST(durability,VALUES(durability))')->execute([$buyerId, $order['weapon_type_id'], $quantity, $order['max_durability']]);
            $remaining = (int)$order['quantity'] - $quantity;
            $this->pdo->prepare("UPDATE market_orders SET quantity=?,status=IF(?=0,'filled','open') WHERE id=?")->execute([$remaining, $remaining, $orderId]);
            $this->pdo->prepare('INSERT INTO market_transactions (order_id,weapon_type_id,seller_id,buyer_id,quantity,unit_price,gross_amount,fee_amount,seller_net) VALUES (?,?,?,?,?,?,?,?,?)')->execute([$orderId,$order['weapon_type_id'],$order['seller_id'],$buyerId,$quantity,$order['unit_price'],$gross,$fee,$sellerNet]);
            $transactionId = (int)$this->pdo->lastInsertId();
            $this->event($buyerId, 'market_weapon_bought', ['order_id'=>$orderId,'transaction_id'=>$transactionId,'quantity'=>$quantity,'gross_amount'=>$gross,'fee_amount'=>$fee,'seller_net'=>$sellerNet]);
            $this->pdo->commit();
            return ['transaction_id'=>$transactionId,'quantity'=>$quantity,'gross_amount'=>$gross,'fee_amount'=>$fee,'seller_net'=>$sellerNet,'weapon_name'=>$order['name']];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }
}
