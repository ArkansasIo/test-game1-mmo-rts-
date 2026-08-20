<?php
declare(strict_types=1);

final class Rules
{
    public static function cannotFarm(PDO $pdo, int $attackerId, int $defenderId): void
    {
        if ($attackerId <= 0 || $defenderId <= 0) {
            throw new InvalidArgumentException('Invalid combat participants');
        }
        if ($attackerId === $defenderId) {
            throw new InvalidArgumentException('A commander cannot target their own realm');
        }
    }
}
