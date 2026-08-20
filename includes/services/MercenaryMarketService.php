<?php
declare(strict_types=1);

final class MercenaryMarketService
{
    public const MAX_QUANTITY = 10000;
    public const MAX_DURATION = 30;
    public const FEE_RATE = 0.05;

    public function __construct(private PDO $pdo) {}

    private function setting(string $key,int $default=0): int
    {
        $s=$this->pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');$s->execute([$key]);$v=$s->fetchColumn();return $v===false?$default:max(0,(int)$v);
    }

    private function event(int $playerId,string $type,int $entityId,array $payload): void
    {
        $s=$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)');$s->execute([$playerId,$type,'mercenary_type',$entityId,json_encode($payload,JSON_THROW_ON_ERROR)]);
    }

    public function snapshot(int $playerId): array
    {
        if($playerId<1)throw new InvalidArgumentException('Invalid mercenary market request.');
        $r=$this->pdo->prepare('SELECT naquadah,population,population_capacity FROM player_resources WHERE player_id=?');$r->execute([$playerId]);$resources=$r->fetch(PDO::FETCH_ASSOC);if(!$resources)throw new RuntimeException('Player resources not found.');
        $q=$this->pdo->prepare('SELECT mt.id,mt.name,mt.attack_power,mt.defense_power,mt.price,mt.capacity_cost,COALESCE(pm.quantity,0) quantity FROM mercenary_types mt LEFT JOIN player_mercenaries pm ON pm.mercenary_type_id=mt.id AND pm.player_id=? ORDER BY mt.price,mt.name');$q->execute([$playerId]);$roster=[];$occupied=0;foreach($q->fetchAll(PDO::FETCH_ASSOC) as $m){$quantity=(int)$m['quantity'];$capacity=(int)$m['capacity_cost'];$occupied+=$quantity*$capacity;$roster[]=['id'=>(int)$m['id'],'name'=>$m['name'],'attack_power'=>(int)$m['attack_power'],'defense_power'=>(int)$m['defense_power'],'base_price'=>(int)$m['price'],'capacity_cost'=>$capacity,'quantity'=>$quantity,'default_duration'=>1,'scarcity_modifier'=>round(1+($capacity*0.1),2)];}
        return ['roster'=>$roster,'resources'=>$resources,'occupied_capacity'=>$occupied,'available_capacity'=>max(0,(int)$resources['population_capacity']-(int)$resources['population']-$occupied),'formula'=>'contract cost = unit tier × contract duration × scarcity modifier','states'=>['ready','empty','insufficient-resource','success','error']];
    }

    public function buy(int $playerId,int $mercenaryTypeId,int $quantity,int $duration=1): array
    {
        if($playerId<1||$mercenaryTypeId<1)throw new InvalidArgumentException('Invalid mercenary purchase request.');if($quantity<1||$quantity>self::MAX_QUANTITY)throw new InvalidArgumentException('Mercenary quantity must be between 1 and '.self::MAX_QUANTITY.'.');if($duration<1||$duration>self::MAX_DURATION)throw new InvalidArgumentException('Contract duration must be between 1 and '.self::MAX_DURATION.' days.');
        $this->pdo->beginTransaction();try{$cooldown=$this->setting('mercenary_buy_cooldown_seconds');$c=$this->pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='mercenary_buy' FOR UPDATE");$c->execute([$playerId]);$available=$c->fetchColumn();if($available!==false&&new DateTimeImmutable((string)$available)>new DateTimeImmutable('now'))throw new RuntimeException('Mercenary recruitment is on cooldown.');$s=$this->pdo->prepare('SELECT id,name,attack_power,defense_power,price,capacity_cost FROM mercenary_types WHERE id=? FOR UPDATE');$s->execute([$mercenaryTypeId]);$type=$s->fetch(PDO::FETCH_ASSOC);if(!$type)throw new RuntimeException('Mercenary type not found.');$r=$this->pdo->prepare('SELECT naquadah,population,population_capacity FROM player_resources WHERE player_id=? FOR UPDATE');$r->execute([$playerId]);$resources=$r->fetch(PDO::FETCH_ASSOC);if(!$resources)throw new RuntimeException('Player resources not found.');$s=$this->pdo->prepare('SELECT COALESCE(SUM(pm.quantity*mt.capacity_cost),0) FROM player_mercenaries pm JOIN mercenary_types mt ON mt.id=pm.mercenary_type_id WHERE pm.player_id=?');$s->execute([$playerId]);$occupied=(int)$s->fetchColumn();$capacityCost=(int)$type['capacity_cost']*$quantity;$availableCapacity=(int)$resources['population_capacity']-(int)$resources['population']-$occupied;if($availableCapacity<$capacityCost)throw new RuntimeException('Population capacity is insufficient for mercenary contracts.');$scarcity=1+((int)$type['capacity_cost']*0.1);$cost=(int)ceil((int)$type['price']*$quantity*$duration*$scarcity);if((int)$resources['naquadah']<$cost)throw new RuntimeException('Not enough Naquadah for mercenary contract.');$this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah-? WHERE player_id=?')->execute([$cost,$playerId]);$this->pdo->prepare('INSERT INTO player_mercenaries(player_id,mercenary_type_id,quantity) VALUES(?,?,?) ON DUPLICATE KEY UPDATE quantity=quantity+VALUES(quantity)')->execute([$playerId,$mercenaryTypeId,$quantity]);$now=new DateTimeImmutable('now');$expires=$now->modify('+'.$duration.' days')->format('Y-m-d H:i:s');if($cooldown>0){$next=$now->modify('+'.$cooldown.' seconds')->format('Y-m-d H:i:s');$this->pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$playerId,'mercenary_buy',$next]);}$this->event($playerId,'mercenary_recruited',(int)$type['id'],['type_id'=>(int)$type['id'],'name'=>$type['name'],'quantity'=>$quantity,'duration_days'=>$duration,'scarcity_modifier'=>round($scarcity,2),'capacity_cost'=>$capacityCost,'cost'=>$cost,'contract_expires_at'=>$expires,'cooldown_seconds'=>$cooldown]);$this->pdo->commit();return ['mercenary_type_id'=>(int)$type['id'],'name'=>$type['name'],'quantity'=>$quantity,'duration_days'=>$duration,'scarcity_modifier'=>round($scarcity,2),'capacity_cost'=>$capacityCost,'cost'=>$cost,'contract_expires_at'=>$expires,'cooldown_seconds'=>$cooldown];}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
