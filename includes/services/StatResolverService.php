<?php
declare(strict_types=1);

final class StatResolverService
{
    private array $catalog;

    public function __construct(private PDO $pdo, ?array $catalog = null)
    {
        $this->catalog = $catalog ?? require __DIR__ . '/../../config/stats_catalog.php';
    }

    public function clamp(string $entityType, float $value, ?float $min = null, ?float $max = null): float
    {
        $defaults = $this->catalog['bounds'][$entityType] ?? ['min' => 0.0, 'max' => 1000000000.0];
        $lower = $min ?? (float)$defaults['min'];
        $upper = $max ?? (float)$defaults['max'];
        if ($lower > $upper) {
            throw new InvalidArgumentException('Invalid stat bounds.');
        }
        return min($upper, max($lower, $value));
    }

    public function resolve(string $entityType, int $entityId, string $statKey): array
    {
        $definition = $this->definition($statKey, $entityType);
        $value = $this->pdo->prepare(
            'SELECT base_value, additive_value, multiplier, min_override, max_override, source_key
             FROM entity_stat_values WHERE entity_type=? AND entity_id=? AND stat_key=?'
        );
        $value->execute([$entityType, $entityId, $statKey]);
        $base = $value->fetch(PDO::FETCH_ASSOC) ?: [
            'base_value' => $definition['base_value'],
            'additive_value' => 0,
            'multiplier' => 1,
            'min_override' => null,
            'max_override' => null,
            'source_key' => 'definition',
        ];

        $mods = $this->pdo->prepare(
            'SELECT modifier_key, modifier_kind, additive_value, multiplier, min_override, max_override, source_key, starts_at, expires_at
             FROM entity_stat_modifiers
             WHERE entity_type=? AND entity_id=? AND stat_key=? AND active=1
               AND starts_at <= NOW() AND (expires_at IS NULL OR expires_at > NOW())
             ORDER BY id ASC'
        );
        $mods->execute([$entityType, $entityId, $statKey]);
        $modifierRows = $mods->fetchAll(PDO::FETCH_ASSOC);

        $additive = (float)$base['additive_value'];
        $multiplier = (float)$base['multiplier'];
        $min = $base['min_override'] === null ? (float)$definition['min_value'] : (float)$base['min_override'];
        $max = $base['max_override'] === null ? (float)$definition['max_value'] : (float)$base['max_override'];
        $sources = [[
            'source_key' => (string)$base['source_key'],
            'modifier_key' => 'base',
            'kind' => 'base',
            'additive' => (float)$base['additive_value'],
            'multiplier' => (float)$base['multiplier'],
        ]];

        foreach ($modifierRows as $modifier) {
            $additive += (float)$modifier['additive_value'];
            $multiplier *= (float)$modifier['multiplier'];
            if ($modifier['min_override'] !== null) {
                $min = max($min, (float)$modifier['min_override']);
            }
            if ($modifier['max_override'] !== null) {
                $max = min($max, (float)$modifier['max_override']);
            }
            $sources[] = [
                'source_key' => (string)$modifier['source_key'],
                'modifier_key' => (string)$modifier['modifier_key'],
                'kind' => (string)$modifier['modifier_kind'],
                'additive' => (float)$modifier['additive_value'],
                'multiplier' => (float)$modifier['multiplier'],
                'starts_at' => $modifier['starts_at'],
                'expires_at' => $modifier['expires_at'],
            ];
        }

        $raw = ((float)$base['base_value'] + $additive) * $multiplier;
        $resolved = $this->clamp($entityType, $raw, $min, $max);
        return [
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'stat_key' => $statKey,
            'label' => $definition['label'],
            'group' => $definition['stat_group'],
            'description' => $definition['description'],
            'value_kind' => $definition['value_kind'],
            'base_value' => (float)$base['base_value'],
            'additive_value' => $additive,
            'multiplier' => $multiplier,
            'raw_value' => $raw,
            'resolved_value' => $resolved,
            'min_value' => $min,
            'max_value' => $max,
            'sources' => $sources,
        ];
    }

    public function resolveMany(string $entityType, int $entityId, ?array $statKeys = null): array
    {
        if ($statKeys === null) {
            $stmt = $this->pdo->prepare('SELECT stat_key FROM stat_definitions WHERE entity_type=? AND is_active=1 ORDER BY stat_group, stat_key');
            $stmt->execute([$entityType]);
            $statKeys = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'stat_key');
        }
        $resolved = [];
        foreach ($statKeys as $key) {
            $resolved[(string)$key] = $this->resolve($entityType, $entityId, (string)$key);
        }
        return $resolved;
    }

    public function setBaseValue(string $entityType, int $entityId, string $statKey, float $baseValue, string $sourceKey = 'base'): void
    {
        $definition = $this->definition($statKey, $entityType);
        $bounded = $this->clamp($entityType, $baseValue, (float)$definition['min_value'], (float)$definition['max_value']);
        $stmt = $this->pdo->prepare(
            'INSERT INTO entity_stat_values (entity_type,entity_id,stat_key,base_value,source_key)
             VALUES (?,?,?,?,?)
             ON DUPLICATE KEY UPDATE base_value=VALUES(base_value), source_key=VALUES(source_key)'
        );
        $stmt->execute([$entityType, $entityId, $statKey, $bounded, $sourceKey]);
    }

    public function addModifier(
        string $entityType,
        int $entityId,
        string $statKey,
        string $modifierKey,
        string $modifierKind,
        float $additive,
        float $multiplier,
        string $sourceKey,
        ?string $startsAt = null,
        ?string $expiresAt = null,
        ?float $minOverride = null,
        ?float $maxOverride = null
    ): int {
        $this->definition($statKey, $entityType);
        if ($multiplier < 0) {
            throw new InvalidArgumentException('Modifier multiplier cannot be negative.');
        }
        $allowedKinds = ['buff', 'debuff', 'temporary', 'aura', 'technology', 'government', 'race', 'biome', 'condition'];
        if (!in_array($modifierKind, $allowedKinds, true)) {
            throw new InvalidArgumentException('Unsupported modifier kind.');
        }
        $stmt = $this->pdo->prepare(
            'INSERT INTO entity_stat_modifiers
             (entity_type,entity_id,stat_key,modifier_key,modifier_kind,additive_value,multiplier,min_override,max_override,source_key,starts_at,expires_at)
             VALUES (?,?,?,?,?,?,?,?,?,?,COALESCE(?,NOW()),?)'
        );
        $stmt->execute([$entityType, $entityId, $statKey, $modifierKey, $modifierKind, $additive, $multiplier, $minOverride, $maxOverride, $sourceKey, $startsAt, $expiresAt]);
        return (int)$this->pdo->lastInsertId();
    }

    public function deactivateModifier(int $modifierId): void
    {
        $stmt = $this->pdo->prepare('UPDATE entity_stat_modifiers SET active=0 WHERE id=?');
        $stmt->execute([$modifierId]);
    }

    private function definition(string $statKey, string $entityType): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM stat_definitions WHERE stat_key=? AND entity_type=? AND is_active=1');
        $stmt->execute([$statKey, $entityType]);
        $definition = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$definition) {
            throw new InvalidArgumentException("Unknown active stat {$entityType}:{$statKey}.");
        }
        return $definition;
    }
}
