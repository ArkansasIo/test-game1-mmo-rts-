<?php
declare(strict_types=1);

final class DesignCatalogService
{
    private array $catalog;

    public function __construct(private ?PDO $pdo = null)
    {
        $this->catalog = require __DIR__ . '/../../config/design_catalog.php';
    }

    public function snapshot(): array
    {
        return [
            'version' => $this->catalog['version'],
            'resources' => $this->catalog['resources'],
            'biomes' => $this->catalog['biomes'],
            'building_count' => count($this->catalog['buildings']),
            'technology_count' => count($this->catalog['technologies']),
            'ship_count' => count($this->catalog['ships']),
            'defense_count' => count($this->catalog['defenses']),
            'troop_count' => count($this->catalog['troops']),
            'mission_types' => array_keys($this->catalog['missions']),
            'officers' => $this->catalog['officers'],
            'events' => $this->catalog['events'],
        ];
    }

    public function get(string $type, string $key): array
    {
        $value = $this->catalog[$type][$key] ?? null;
        if (!is_array($value)) throw new InvalidArgumentException('Unknown design catalog entry.');
        return ['type'=>$type,'key'=>$key,'version'=>$this->catalog['version'],'entry'=>$value];
    }

    public function all(string $type): array
    {
        $items = $this->catalog[$type] ?? null;
        if (!is_array($items)) throw new InvalidArgumentException('Unknown design catalog type.');
        return ['type'=>$type,'version'=>$this->catalog['version'],'items'=>$items];
    }

    public function formula(string $key): ?array
    {
        if (!$this->pdo) return null;
        $stmt = $this->pdo->prepare('SELECT formula_key,version,expression,variables,source_section FROM game_formula_definitions WHERE formula_key=? AND is_active=1');
        $stmt->execute([$key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        $row['variables'] = json_decode((string)$row['variables'], true) ?: [];
        return $row;
    }
}
