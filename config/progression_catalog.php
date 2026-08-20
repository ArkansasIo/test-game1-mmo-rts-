<?php
declare(strict_types=1);
return [
 'tier_count'=>21,
 'levels_per_tier'=>23,
 'total_levels'=>483,
 'tier_names'=>['Awakening','Initiate','Frontier','Settler','Architect','Warden','Commander','Admiral','Strategist','Dominion','Ascendant','Stellar','Nebular','Galactic','Eternal','Transcendent','Singularity','Omniscient','Apex','Mythic','Gatebreaker'],
 'categories'=>['player','building','technology','unit','fleet','defense','colony','mothership','exploration','diplomacy','race','government'],
 'formulae'=>[
  'global_level'=>'((tier - 1) × 23) + level',
  'experience_cost'=>'1000 × global_level²',
  'resource_cost'=>'Base resource cost × global_level',
  'effect'=>'global_level × 0.75 percent',
  'queue_time'=>'60 + (global_level × 30) seconds',
  'tier_unlock'=>'Previous tier level 23 completed plus category prerequisites',
 ],
 'states'=>['locked','available','insufficient-resource','prerequisite-failed','queued','researching','building','complete','maximum'],
];
