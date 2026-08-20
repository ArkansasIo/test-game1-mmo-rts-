<?php
declare(strict_types=1);
return [
 'resources'=>[
  'metal'=>['symbol'=>'M','label'=>'Metal','function'=>'Buildings, defenses, and ships'],
  'crystal'=>['symbol'=>'C','label'=>'Crystal','function'=>'Technology and advanced buildings'],
  'naquadah'=>['symbol'=>'N','label'=>'Naquadah','function'=>'Advanced energy, Stargates, and ships'],
  'energy'=>['symbol'=>'E','label'=>'Energy','function'=>'Infrastructure and production power'],
  'dark_matter'=>['symbol'=>'DM','label'=>'Dark Matter','function'=>'Premium and special actions'],
  'food'=>['symbol'=>'F','label'=>'Food','function'=>'Population consumption and growth'],
  'water'=>['symbol'=>'W','label'=>'Water','function'=>'Population consumption, agriculture, and industry'],
  'population'=>['symbol'=>'POP','label'=>'Population','function'=>'Workforce, housing, taxes, and recruitment'],
 ],
 'formulas'=>[
  'population_capacity'=>'POP_CAP = Housing + Infrastructure + Planetary_Bonuses',
  'food_consumption'=>'Food_Use = Population × Food_Rate × Elapsed_Hours',
  'water_consumption'=>'Water_Use = Population × Water_Rate × Elapsed_Hours',
  'food_availability'=>'Food_Availability = min(1, Food_Stock / max(1, Food_Use))',
  'water_availability'=>'Water_Availability = min(1, Water_Stock / max(1, Water_Use))',
  'population_growth'=>'POP_GROWTH = Population × Growth_Rate × Food_Availability × Water_Availability × Elapsed_Hours',
  'workforce'=>'WORKFORCE = min(Population, Population_Capacity) × Workforce_Rate',
  'production'=>'Production = Base_Output × Workforce_Modifier × Race_Modifier × Government_Modifier × Biome_Modifier × Energy_Availability',
 ],
 'states'=>['nominal','food_shortage','water_shortage','capacity_reached','energy_deficit','protected','insufficient-resource','success','error'],
];
