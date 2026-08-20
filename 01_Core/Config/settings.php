<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

const DEFAULT_GAME_SETTINGS = [
    'turn_interval_seconds' => 1800,
    'turn_generation_threshold' => 4000,
    'turn_max_storage' => 10000,
    'natural_income_untrained' => 20,
    'natural_income_miner' => 80,
    'lifer_ratio' => 10,
    'market_turns_weekly' => 3,
    'max_defcon' => 4,
    'max_messages_daily' => 50,
    'max_officer_count' => 10,
    'max_planets' => 10,
    'max_alliance_members' => 100,
    'raid_rank_range' => 10,
    'attack_daily_target_limit' => 5,
];

function game_setting(string $key, int|float|string|null $fallback = null): int|float|string|null {
    static $settings = null;
    if ($settings === null) {
        $settings = DEFAULT_GAME_SETTINGS;
        $pdo = db();
        if ($pdo) {
            try {
                foreach ($pdo->query('SELECT setting_key, setting_value FROM game_settings')->fetchAll() as $row) {
                    $settings[$row['setting_key']] = is_numeric($row['setting_value']) ? (str_contains($row['setting_value'], '.') ? (float)$row['setting_value'] : (int)$row['setting_value']) : $row['setting_value'];
                }
            } catch (Throwable $e) { /* defaults remain available */ }
        }
    }
    return $settings[$key] ?? $fallback;
}

function game_settings_snapshot(): array {
    $out = [];
    foreach (array_keys(DEFAULT_GAME_SETTINGS) as $key) $out[$key] = game_setting($key);
    return $out;
}
