<?php
return [
    'purpose' => 'Validate a coordinate tuple through the galaxy, sector, system, and orbit hierarchy, then apply discovery and ownership visibility.',
    'workflow' => [
        'validate coordinate input',
        'find active galaxy',
        'find active sector within the galaxy',
        'find active solar system within the sector',
        'find planet at the requested orbit slot',
        'apply discovery filter',
        'classify ownership and return scoped navigation identifiers',
    ],
    'validation' => [
        'authenticated commander',
        'coordinate format',
        'coordinate bounds',
        'hierarchy validity',
        'discovery or ownership visibility',
    ],
    'calculations' => [
        'coordinate lookup = validated galaxy : sector : system : slot tuple',
        'visibility = discovered system OR commander-owned colony',
    ],
    'mutations' => [],
];
