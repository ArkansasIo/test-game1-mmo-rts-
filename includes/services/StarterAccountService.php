<?php
declare(strict_types=1);

final class StarterAccountService
{
    public static function seed(PDO $pdo, int $playerId): void
    {
        if ($playerId < 1) {
            throw new InvalidArgumentException('Invalid starter-account player ID.');
        }

        $config = require __DIR__ . '/../../config/starter_account.php';
        $starter = array_merge(
            $config['resources'] ?? [],
            $config['capacities'] ?? [],
            $config['turns'] ?? [],
            $config['units'] ?? []
        );

        $resourceInsert = $pdo->prepare(
            'INSERT INTO player_resources '
            . '(player_id,metal,crystal,deuterium,naquadah,energy,dark_matter,food,water,population,population_capacity,deuterium_capacity,banked_naquadah,attack_turns,market_turns,untrained_units,unit_production,miners,lifers,attack_units,defense_units,spies,anti_spies,covert_capacity,workforce) '
            . 'VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
        );
        $resourceInsert->execute([
            $playerId,
            $starter['metal'],
            $starter['crystal'],
            $starter['deuterium'],
            $starter['naquadah'],
            $starter['energy'],
            $starter['dark_matter'],
            $starter['food'],
            $starter['water'],
            $starter['population'],
            $starter['population_capacity'],
            $starter['deuterium_capacity'],
            $starter['banked_naquadah'],
            $starter['attack_turns'],
            $starter['market_turns'],
            $starter['untrained_units'],
            $starter['unit_production'],
            $starter['miners'],
            $starter['lifers'],
            $starter['attack_units'],
            $starter['defense_units'],
            $starter['spies'],
            $starter['anti_spies'],
            $starter['covert_capacity'],
            $starter['workforce'],
        ]);

        $pdo->prepare(
            'INSERT INTO player_empire_limits (player_id,max_planets,max_moons,homeworld_required) '
            . 'VALUES (?,100000,100000,1) '
            . 'ON DUPLICATE KEY UPDATE max_planets=GREATEST(max_planets,100000), max_moons=GREATEST(max_moons,100000), homeworld_required=1'
        )->execute([$playerId]);
    }
}
