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
        $this->pdo->beginTransaction();
        try{$s=$this->pdo->prepare('SELECT pw.id,pw.quantity,pw.durability,wt.name,wt.category,wt.max_durability FROM player_weapons pw JOIN weapon_types wt ON wt.id=pw.weapon_type_id WHERE pw.id=? AND pw.player_id=? FOR UPDATE');$s->execute([$weaponId,$playerId]);$row=$s->fetch();if(!$row)throw new RuntimeException('Weapon inventory not found or not owned.');$estimate=$this->estimate($row);if(!$estimate['repairable'])throw new RuntimeException('Weapon durability is already full.');$r=$this->pdo->prepare('SELECT naquadah FROM player_resources WHERE player_id=? FOR UPDATE');$r->execute([$playerId]);if((int)$r->fetchColumn()<$estimate['repair_cost'])throw new RuntimeException('Not enough Naquadah for repair.');$this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah-? WHERE player_id=?')->execute([$estimate['repair_cost'],$playerId]);$this->pdo->prepare('UPDATE player_weapons SET durability=? WHERE id=? AND player_id=?')->execute([$estimate['max_durability'],$weaponId,$playerId]);$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)')->execute([$playerId,'weapon_repaired','player_weapons',$weaponId,json_encode(['weapon'=>$estimate['name'],'missing_durability'=>$estimate['missing_durability'],'tier'=>$estimate['tier'],'cost'=>$estimate['repair_cost'],'queue_seconds'=>$estimate['queue_seconds']],JSON_THROW_ON_ERROR)]);$this->pdo->commit();return $estimate;}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
