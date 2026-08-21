<?php
declare(strict_types=1);

final class EquipmentStatService
{
    public function __construct(private PDO $pdo) {}

    public function resolveDesign(string $designKey, int $level = 1, float $technologyMultiplier = 1.0): array
    {
        if (!preg_match('/^[A-Z0-9_-]{5,40}$/', $designKey)) {
            throw new InvalidArgumentException('Invalid equipment design key.');
        }
        $stmt = $this->pdo->prepare('SELECT ed.*,ec.equipment_group,ec.class_name,ec.subclass_code,ec.description class_description FROM equipment_design_catalog ed JOIN equipment_class_catalog ec ON ec.class_id=ed.class_id WHERE ed.design_key=?');
        $stmt->execute([$designKey]);
        $design = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$design) {
            throw new RuntimeException('Equipment design not found.');
        }
        $level = max(1, min((int)$design['max_level'], $level));
        $technologyMultiplier = max(0.10, min(10.0, $technologyMultiplier));
        $stats = [
            'offense_power' => (float)$design['base_offense'],
            'defense_power' => (float)$design['base_defense'],
            'shield_power' => (float)$design['base_shield'],
            'armor_power' => (float)$design['base_armor'],
            'accuracy' => (float)$design['accuracy'],
            'penetration' => (float)$design['penetration'],
            'resistance' => (float)$design['resistance'],
            'mobility' => (float)$design['mobility'],
            'sensor_bonus' => (float)$design['sensor_bonus'],
            'power_draw' => (float)$design['power_draw'],
            'heat_generation' => (float)$design['heat_generation'],
        ];
        foreach ($stats as $key => $value) {
            $scaled = $value * $level * $technologyMultiplier;
            $stats[$key] = match ($key) {
                'accuracy', 'penetration', 'resistance' => round(max(0.0, min(5.0, $scaled)), 4),
                'mobility' => round(max(0.05, min(5.0, $scaled)), 4),
                'power_draw', 'heat_generation' => round(max(0.0, min(1000000.0, $scaled)), 3),
                default => round(max(0.0, min(1000000000.0, $scaled)), 3),
            };
        }
        return [
            'state' => 'ready',
            'design_key' => $designKey,
            'display_name' => $design['display_name'],
            'equipment_group' => $design['equipment_group'],
            'class_id' => $design['class_id'],
            'class_name' => $design['class_name'],
            'type_code' => $design['type_code'],
            'subtype_code' => $design['subtype_code'],
            'tier' => (int)$design['tier'],
            'level' => $level,
            'technology_multiplier' => $technologyMultiplier,
            'damage_type' => $design['damage_type'],
            'primary_stat' => $design['primary_stat'],
            'stats' => $stats,
            'costs' => ['metal'=>(int)$design['metal_cost'],'crystal'=>(int)$design['crystal_cost'],'deuterium'=>(int)$design['deuterium_cost'],'naquadah'=>(int)$design['naquadah_cost'],'energy'=>(int)$design['energy_cost']],
            'durability' => (int)$design['durability'],
            'bounds' => ['level_min'=>1,'level_max'=>(int)$design['max_level'],'stat_max'=>1000000000],
            'description' => $design['description'],
        ];
    }

    public function catalog(?string $equipmentGroup = null): array
    {
        $sql = 'SELECT ed.design_key,ed.display_name,ed.class_id,ec.class_name,ec.equipment_group,ed.type_code,ed.subtype_code,ed.tier,ed.max_level,ed.damage_type,ed.primary_stat FROM equipment_design_catalog ed JOIN equipment_class_catalog ec ON ec.class_id=ed.class_id';
        $params = [];
        if ($equipmentGroup !== null) { $sql .= ' WHERE ec.equipment_group=?'; $params[] = $equipmentGroup; }
        $sql .= ' ORDER BY ed.tier,ed.design_key';
        $stmt = $this->pdo->prepare($sql); $stmt->execute($params);
        return ['state'=>$stmt->rowCount() ? 'ready' : 'empty','items'=>$stmt->fetchAll(PDO::FETCH_ASSOC),'bounds'=>['level_min'=>1,'level_max'=>99]];
    }
}
