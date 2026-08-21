<?php
declare(strict_types=1);

/**
 * Shared deterministic formulas from the UCEAW game design catalog.
 * This service is pure where possible; callers remain responsible for
 * authentication, ownership, transactions, persistence, and cooldowns.
 */
final class GameMechanicsService
{
    private array $catalog;

    public function __construct(?array $catalog = null)
    {
        $this->catalog = $catalog ?? require __DIR__ . '/../../config/design_catalog.php';
    }

    public function catalog(): array
    {
        return $this->catalog;
    }

    public function production(float $ratePerHour, int $elapsedSeconds, float $modifier = 1.0, float $upkeep = 0.0): float
    {
        if ($elapsedSeconds <= 0 || $ratePerHour <= 0) return min(0.0, -$upkeep);
        return max(0.0, ($ratePerHour * $elapsedSeconds / 3600.0 * max(0.0, $modifier)) - max(0.0, $upkeep));
    }

    public function cost(string $catalogType, string $key, int $level): array
    {
        if ($level < 1) throw new InvalidArgumentException('Level must be positive.');
        $item = $this->catalog[$catalogType][$key] ?? null;
        if (!is_array($item) || !isset($item['base_cost'])) throw new InvalidArgumentException('Unknown catalog item.');
        $growth = max(1.0, (float)($item['growth'] ?? 1.5));
        $cost = [];
        foreach ($item['base_cost'] as $resource => $amount) {
            $cost[$resource] = (int)ceil((float)$amount * ($growth ** ($level - 1)));
        }
        return $cost;
    }

    public function storageCapacity(int $level, float $base = 10000.0, float $growth = 1.6): int
    {
        return max(0, (int)floor($base * (max(1.0, $growth) ** max(0, $level))));
    }

    public function clampResource(float $value, float $capacity): float
    {
        return max(0.0, min(max(0.0, $capacity), $value));
    }

    public function fleetPower(array $units, float $technology = 1.0, float $race = 1.0, float $government = 1.0, float $planet = 1.0): array
    {
        $attack = 0.0; $defense = 0.0; $cargo = 0.0; $speed = PHP_INT_MAX; $fuel = 0.0;
        foreach ($units as $key => $quantity) {
            $type = $this->catalog['ships'][$key] ?? null;
            if (!$type) continue;
            $n = max(0, (int)$quantity); $base = $type['base'];
            $attack += $n * (float)$base['attack'];
            $defense += $n * (float)$base['defense'];
            $cargo += $n * (float)$base['cargo'];
            if ($n > 0 && (float)$base['speed'] > 0) $speed = min($speed, (float)$base['speed']);
            $fuel += $n * (float)$base['fuel'];
        }
        $multiplier = max(0.0, $technology * $race * $government * $planet);
        return ['attack'=>(int)round($attack*$multiplier),'defense'=>(int)round($defense*$multiplier),'cargo'=>(int)round($cargo),'speed'=>$speed===PHP_INT_MAX?0:(int)$speed,'fuel'=>(int)ceil($fuel)];
    }

    public function travelSeconds(int $distance, int $fleetSpeed, float $driveModifier = 1.0, float $universeSpeed = 1.0): int
    {
        if ($distance < 0 || $fleetSpeed <= 0) throw new InvalidArgumentException('Invalid travel inputs.');
        return max(1, (int)ceil(($distance * 3600.0 / $fleetSpeed) / max(0.1, $driveModifier) / max(0.1, $universeSpeed)));
    }

    public function fuelCost(int $distance, int $fleetMass, float $efficiency = 1.0): int
    {
        return max(0, (int)ceil(max(0, $distance) * max(0, $fleetMass) * 0.001 / max(0.1, $efficiency)));
    }

    public function combatPower(int $units, float $basePower, float $technology = 1.0, float $race = 1.0, float $government = 1.0, float $planet = 1.0): int
    {
        return max(0, (int)round(max(0, $units) * max(0, $basePower) * max(0, $technology) * max(0, $race) * max(0, $government) * max(0, $planet)));
    }

    public function rapidFireDamage(float $attackPower, float $defensePower, float $rapidFire = 1.0, int $rounds = 1): array
    {
        $rounds = max(1, min(20, $rounds));
        $raw = max(0.0, $attackPower * (1.0 + max(0.0, $rapidFire - 1.0) * 0.10) * $rounds - $defensePower);
        return ['damage'=>(int)round($raw),'rounds'=>$rounds,'outcome'=>$raw>0?'attacker_advantage':($raw<0?'defender_advantage':'draw')];
    }

    public function loot(int $available, float $lootRate = 0.50, int $cap = PHP_INT_MAX): int
    {
        return max(0, min($cap, (int)floor(max(0, $available) * max(0.0, min(1.0, $lootRate)))));
    }

    public function debris(int $metalLoss, int $crystalLoss, float $recoveryRate = 0.30): array
    {
        $rate = max(0.0, min(1.0, $recoveryRate));
        return ['metal'=>(int)floor(max(0, $metalLoss)*$rate),'crystal'=>(int)floor(max(0, $crystalLoss)*$rate)];
    }

    public function espionageDetection(float $counterIntelligence, int $agents, float $covertTechnology = 1.0, float $missionRisk = 1.0): float
    {
        return max(0.0, min(1.0, (($counterIntelligence * max(0.1, $missionRisk)) - max(0, $agents) * max(0.1, $covertTechnology)) / 100.0));
    }

    public function populationGrowth(float $population, float $housingCapacity, float $foodRatio, float $waterRatio, float $stability = 1.0, int $elapsedSeconds = 3600): int
    {
        if ($population <= 0 || $housingCapacity <= $population || $foodRatio <= 0 || $waterRatio <= 0) return 0;
        $capacityFactor = max(0.0, min(1.0, ($housingCapacity - $population) / max(1.0, $housingCapacity)));
        $lifeSupport = max(0.0, min(1.0, min($foodRatio, $waterRatio)));
        return max(0, (int)floor($population * 0.01 * $capacityFactor * $lifeSupport * max(0.0, $stability) * ($elapsedSeconds / 86400.0)));
    }

    public function stability(float $base, float $foodRatio, float $waterRatio, float $pollution, float $governmentModifier = 1.0, float $eventModifier = 0.0): float
    {
        $value = $base + (($foodRatio - 1.0) * 0.30) + (($waterRatio - 1.0) * 0.30) - max(0.0, $pollution) * 0.20;
        return max(0.0, min(1.0, $value * max(0.0, $governmentModifier) + $eventModifier));
    }

    public function rankingScore(float $economy, float $military, float $research, float $glory, float $penalties = 0.0): int
    {
        return max(0, (int)round($economy + $military + $research + $glory - max(0.0, $penalties)));
    }

    public function validateKey(string $catalogType, string $key): bool
    {
        return isset($this->catalog[$catalogType][$key]);
    }
}
