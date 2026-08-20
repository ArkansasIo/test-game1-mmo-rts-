<?php
declare(strict_types=1);

final class FormulaService
{
    public static function naturalIncome(int $untrained, int $miners, int $lifers, float $raceIncome = 1.0, float $defconMultiplier = 1.0, float $commanderMultiplier = 1.0, float $planetIncome = 0.0): int
    {
        $base = ($untrained * 20) + (($miners + $lifers) * 80) + $planetIncome;
        return max(0, (int) round($base * $raceIncome * $defconMultiplier * $commanderMultiplier));
    }

    public static function bankCapacity(int $naturalIncome): int
    {
        return max(0, (int) round($naturalIncome * 48 * 1.5));
    }

    public static function unitProductionCost(int $current): int
    {
        return max(0, ($current * 5000) + 10000);
    }

    public static function strike(int $normalWeapons, int $superWeapons, float $offenseTech = 1.0, float $raceModifier = 1.0, float $planetBonus = 0.0, float $mothershipPower = 0.0): int
    {
        return max(0, (int) round((($normalWeapons * 5) + ($superWeapons * 10) + $planetBonus + $mothershipPower) * $offenseTech * $raceModifier));
    }

    public static function defense(int $normalWeapons, int $superWeapons, float $defenseTech = 1.0, float $raceModifier = 1.0, float $planetBonus = 0.0, float $mothershipPower = 0.0): int
    {
        return max(0, (int) round((($normalWeapons * 5) + ($superWeapons * 10) + $planetBonus + $mothershipPower) * $defenseTech * $raceModifier));
    }

    public static function covert(int $spyLevel, int $spyCount, float $covertTech = 1.0, float $raceModifier = 1.0, float $planetBonus = 0.0): int
    {
        $quality = sqrt(2 ** max(0, $spyLevel));
        return max(0, (int) round((($quality * $spyCount * $covertTech * $raceModifier) + $spyCount + $planetBonus) * 10));
    }

    public static function antiCovert(int $level, int $agentCount, float $technology = 1.0, float $raceModifier = 1.0, float $planetBonus = 0.0): int
    {
        $quality = sqrt(2 ** max(0, $level + 2));
        return max(0, (int) round((($quality * $agentCount * $technology * $raceModifier) + $agentCount + $planetBonus) * 10));
    }

    public static function overallRank(float $attack, float $defense, float $covert, float $mothership): float
    {
        return ($attack + $defense + $covert + $mothership) / 4;
    }

    public static function planetAttack(int $base, int $level): int { return $base + ($level * 30000); }
    public static function planetDefense(int $base, int $level): int { return $base + ($level * 25000); }
    public static function planetCovert(int $base, int $level): int { return $base + ($level * 181000); }
    public static function planetIncome(int $bonusLevel): int { return 8000 + ($bonusLevel * 3840); }
    public static function planetProduction(int $bonusLevel): int { return 100 + $bonusLevel; }

    public static function defconIncomeMultiplier(int $level): float
    {
        return [0 => 1.0, 1 => 0.90, 2 => 0.80, 3 => 0.60, 4 => 0.30][max(0, min(4, $level))];
    }

    public static function defconCovertProtection(int $level): float
    {
        return [0 => 1.0, 1 => 1.10, 2 => 1.20, 3 => 1.40, 4 => 1.70][max(0, min(4, $level))];
    }
}
