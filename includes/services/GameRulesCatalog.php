<?php
declare(strict_types=1);
final class GameRulesCatalog {
    public static function turnIntervalSeconds(): int { return 1800; }
    public static function maxTurnsPerSettlement(): int { return 24; }
    public static function resourceProduction(int $base, float $modifier, int $turns, float $bonus = 0.0): int {
        if ($base < 0 || $turns < 0) throw new InvalidArgumentException('Production values must be non-negative');
        return max(0, (int)floor($base * max(0.0, $modifier) * $turns * (1.0 + $bonus)));
    }
    public static function lifeSupportDelta(int $stock, int $consumption, int $turns, int $capacity): array {
        $next = $stock - max(0, $consumption) * max(0, $turns);
        return ['stock'=>max(0,min($capacity,$next)),'shortage'=>$next<0,'deficit'=>max(0,-$next)];
    }
    public static function fleetTravelSeconds(int $baseSeconds, float $travelModifier, int $distance, float $engineBonus = 0.0): int {
        if ($baseSeconds < 1 || $distance < 0) throw new InvalidArgumentException('Invalid travel inputs');
        return max(1,(int)ceil($baseSeconds * max(0.1,$travelModifier) * max(1,$distance) / max(0.1,1.0+$engineBonus)));
    }
    public static function combatPower(int $units, int $unitPower, int $technologyLevel = 0, float $planetBonus = 0.0): int {
        return max(0,(int)floor($units * $unitPower * (1 + $technologyLevel * 0.05) * (1 + $planetBonus)));
    }
    public static function espionageDetection(int $agents, int $defense, int $technologyLevel = 0): float {
        $chance = 0.50 + (($defense - ($agents + $technologyLevel * 10)) / 1000);
        return max(0.05,min(0.95,$chance));
    }
    public static function experienceToNextLevel(int $level): int { return max(1000,$level*1000); }
    public static function queueCompletion(int $baseSeconds, int $level, float $speedBonus = 0.0): int {
        return max(1,(int)ceil($baseSeconds * max(1,$level) / max(0.1,1+$speedBonus)));
    }
    public static function allowedMissionTypes(): array { return ['transport','attack','raid','espionage','colonize','recycle','explore','return']; }
    public static function allowedDiplomacyTypes(): array { return ['nap','trade','alliance','war','ceasefire']; }
}
