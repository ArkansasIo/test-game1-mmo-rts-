<?php
declare(strict_types=1);

final class WeaponRepairService
{
    public const REPAIR_MULTIPLIER = 10;

    public function __construct(private PDO $pdo) {}

    private function tier(string $category): int
    {
        return match ($category) {
            'super_attack', 'super_defense' => 2,
            'mothership' => 4,
            default => 1,
        };
    }

    private function estimate(array $row): array
    {
        $missing=max(0,(int)$row['max_durability']-(int)$row['durability']);$tier=$this->tier((string)$row['category']);$cost=$missing*$tier*self::REPAIR_MULTIPLIER;$seconds=$missing*5*$tier;return ['id'=>(int)$row['id'],'name'=>$row['name'],'category'=>$row['category'],'quantity'=>(int)$row['quantity'],'durability'=>(int)$row['durability'],'max_durability'=>(int)$row['max_durability'],'missing_durability'=>$missing,'tier'=>$tier,'repair_multiplier'=>self::REPAIR_MULTIPLIER,'repair_cost'=>$cost,'queue_seconds'=>$seconds,'condition_percent'=>$row['max_durability']>0?round(((int)$row['durability']/(int)$row['max_durability'])*100,1):0,'repairable'=>$missing>0];
    }

    public function snapshot(int $playerId): array
    {
        $s=$this->pdo->prepare('SELECT pw.id,pw.quantity,pw.durability,wt.name,wt.category,wt.max_durability FROM player_weapons pw JOIN weapon_types wt ON wt.id=pw.weapon_type_id WHERE pw.player_id=? ORDER BY (wt.max_durability-pw.durability) DESC,wt.name');$s->execute([$playerId]);$items=array_map(fn(array $r)=>$this->estimate($r),$s->fetchAll());$damaged=array_values(array_filter($items,fn($r)=>$r['repairable']));$cost=array_sum(array_column($damaged,'repair_cost'));$seconds=array_sum(array_column($damaged,'queue_seconds'));return ['items'=>$items,'damaged'=>$damaged,'damaged_count'=>count($damaged),'total_repair_cost'=>$cost,'total_queue_seconds'=>$seconds,'repair_multiplier'=>self::REPAIR_MULTIPLIER,'formula'=>'repair cost = missing durability × weapon tier × repair multiplier','states'=>['ready','empty','insufficient-resource','success','error']];
    }

    public function repair(int $playerId,int $weaponId): array
    {
        if($playerId<1||$weaponId<1)throw new InvalidArgumentException('Invalid weapon repair request');
        $this->pdo->beginTransaction();
        try {
            $cooldownSeconds=(int)($this->pdo->query("SELECT setting_value FROM game_settings WHERE setting_key='weapon_repair_cooldown_seconds'")->fetchColumn() ?: 0);
            $cooldownStmt=$this->pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='weapon_repair' FOR UPDATE");$cooldownStmt->execute([$playerId]);$availableAt=$cooldownStmt->fetchColumn();if($availableAt!==false&&new DateTimeImmutable((string)$availableAt)>new DateTimeImmutable('now'))throw new RuntimeException('Weapon repair is on cooldown.');
            $s=$this->pdo->prepare('SELECT pw.id,pw.quantity,pw.durability,wt.name,wt.category,wt.max_durability FROM player_weapons pw JOIN weapon_types wt ON wt.id=pw.weapon_type_id WHERE pw.id=? AND pw.player_id=? FOR UPDATE');$s->execute([$weaponId,$playerId]);$row=$s->fetch(PDO::FETCH_ASSOC);if(!$row)throw new RuntimeException('Weapon inventory not found or not owned.');
            $estimate=$this->estimate($row);if(!$estimate['repairable'])throw new RuntimeException('Weapon durability is already full.');
            $r=$this->pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=? FOR UPDATE');$r->execute([$playerId]);if((int)$r->fetchColumn()<$estimate['repair_cost'])throw new RuntimeException('Not enough Naquadah for repair.');
            $this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah-? WHERE player_id=?')->execute([$estimate['repair_cost'],$playerId]);
            $now=new DateTimeImmutable('now');$startsAt=$now->format('Y-m-d H:i:s');$completesAt=$now->modify('+'.$estimate['queue_seconds'].' seconds')->format('Y-m-d H:i:s');
            $queue=$this->pdo->prepare("INSERT INTO construction_queue(player_id,colony_id,queue_type,item_key,quantity,level_before,starts_at,completes_at,status) VALUES(?,NULL,'weapon_repair',?,?,0,?,?, 'completed')");$queue->execute([$playerId,'weapon:'.$weaponId,1,$startsAt,$completesAt]);$queueId=(int)$this->pdo->lastInsertId();
            $this->pdo->prepare('UPDATE player_weapons SET durability=? WHERE id=? AND player_id=?')->execute([$estimate['max_durability'],$weaponId,$playerId]);
            if($cooldownSeconds>0){$next=$now->modify('+'.$cooldownSeconds.' seconds')->format('Y-m-d H:i:s');$this->pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$playerId,'weapon_repair',$next]);}
            $this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)')->execute([$playerId,'weapon_repaired','player_weapons',$weaponId,json_encode(['weapon'=>$estimate['name'],'missing_durability'=>$estimate['missing_durability'],'tier'=>$estimate['tier'],'cost'=>$estimate['repair_cost'],'queue_seconds'=>$estimate['queue_seconds'],'construction_queue_id'=>$queueId,'cooldown_seconds'=>$cooldownSeconds],JSON_THROW_ON_ERROR)]);
            $this->pdo->commit();$estimate['durability']=$estimate['max_durability'];$estimate['condition_percent']=100;$estimate['repairable']=false;$estimate['construction_queue_id']=$queueId;$estimate['cooldown_seconds']=$cooldownSeconds;return $estimate;
        }catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
