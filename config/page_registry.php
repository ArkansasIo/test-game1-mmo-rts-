<?php
declare(strict_types=1);
return [
 'command-center'=>[
  'label'=>'Command Center','icon'=>'⌂','pages'=>[
   'dashboard'=>['title'=>'Command Center','layout'=>'dashboard','controls'=>['Process turns','Choose target','Review reports'],'actions'=>['process_turns'],'tables'=>['players','player_resources','rankings','game_events']],
   'account-info'=>['title'=>'Account Information','layout'=>'details','controls'=>['View profile','View rank','View protection'],'actions'=>[],'tables'=>['players','races','rankings','glory_reputation']],
   'resources'=>['title'=>'Resources & Vault','layout'=>'economy','controls'=>['Deposit','Withdraw'],'actions'=>['deposit','withdraw'],'tables'=>['player_resources','game_settings']],
   'income'=>['title'=>'Income Breakdown','layout'=>'breakdown','controls'=>['View income formula'],'actions'=>[],'tables'=>['player_resources','races','player_planets','game_settings']],
   'military-stats'=>['title'=>'Military Statistics','layout'=>'stats','controls'=>['View attack','View defense','View covert'],'actions'=>[],'tables'=>['player_resources','player_unit_stats','rankings']],
  ]],
 'attack'=>[
  'label'=>'Attack','icon'=>'⚔','pages'=>[
   'targets'=>['title'=>'Target Selection','layout'=>'targets','controls'=>['Attack','Raid','Spy','Sabotage','Conquer Planet','Message'],'actions'=>['combat','covert','explore','message'],'tables'=>['target_realms','players','battles']],
   'spy'=>['title'=>'Spy Operations','layout'=>'covert','controls'=>['Run reconnaissance','Run spy mission'],'actions'=>['covert'],'tables'=>['covert_missions','spy_missions','intelligence_reports']],
   'sabotage'=>['title'=>'Sabotage Operations','layout'=>'covert','controls'=>['Choose system','Run sabotage'],'actions'=>['covert'],'tables'=>['covert_missions','sabotage_missions']],
   'attack-log'=>['title'=>'Attack Log & Reports','layout'=>'reports','controls'=>['Open report','Mark read'],'actions'=>['message_read'],'tables'=>['battles','battle_reports','attack_logs']],
  ]],
 'armory'=>['label'=>'Armory','icon'=>'▣','pages'=>[
   'weapons'=>['title'=>'Weapon Inventory','layout'=>'inventory','controls'=>['Buy weapon','Inspect durability'],'actions'=>['weapon_buy'],'tables'=>['weapon_types','player_weapons']],
   'weapon-market'=>['title'=>'Weapon Market','layout'=>'market','controls'=>['List order','Buy order'],'actions'=>['market_list','market_buy'],'tables'=>['market_orders','weapon_types']],
   'repair'=>['title'=>'Weapon Repair','layout'=>'repair','controls'=>['Repair weapon'],'actions'=>['weapon_repair'],'tables'=>['player_weapons','player_resources']],
 ]],
 'training'=>['label'=>'Training','icon'=>'◈','pages'=>[
   'units'=>['title'=>'Unit Training','layout'=>'training','controls'=>['Train units'],'actions'=>['train','upgrade_up'],'tables'=>['unit_types','player_unit_stats','training_queues','player_resources','game_events']],
   'miners'=>['title'=>'Miners & Lifers','layout'=>'training','controls'=>['Train miners'],'actions'=>['train'],'tables'=>['player_resources']],
   'super-units'=>['title'=>'Super Units','layout'=>'training','controls'=>['Train elite units'],'actions'=>['train'],'tables'=>['player_resources','technologies']],
   'unit-production'=>['title'=>'Unit Production','layout'=>'upgrade','controls'=>['Upgrade UP'],'actions'=>['upgrade_up'],'tables'=>['unit_types','player_unit_stats','training_queues','player_resources','game_events']],
 ]],
 'technology'=>['label'=>'Technology','icon'=>'◇','pages'=>[
   'technology'=>['title'=>'Technology Tree','layout'=>'technology','controls'=>['Upgrade offense','Upgrade defense','Upgrade covert','Upgrade anti-covert'],'actions'=>['technology'],'tables'=>['technologies','player_technologies']],
   'tech-offense'=>['title'=>'Offense Technology','layout'=>'technology','controls'=>['Upgrade'],'actions'=>['technology'],'tables'=>['technologies','player_technologies']],
   'tech-defense'=>['title'=>'Defense Technology','layout'=>'technology','controls'=>['Upgrade'],'actions'=>['technology'],'tables'=>['technologies','player_technologies']],
   'tech-covert'=>['title'=>'Covert Technology','layout'=>'technology','controls'=>['Upgrade'],'actions'=>['technology'],'tables'=>['technologies','player_technologies']],
   'tech-anti-covert'=>['title'=>'Anti-Covert Technology','layout'=>'technology','controls'=>['Upgrade'],'actions'=>['technology'],'tables'=>['technologies','player_technologies']],
 ]],
 'intelligence'=>['label'=>'Intelligence','icon'=>'◎','pages'=>[
   'spy-log'=>['title'=>'Spy Log','layout'=>'reports','controls'=>['Open report','Mark read'],'actions'=>['message_read'],'tables'=>['covert_missions','intelligence_reports']],
   'enemy-intelligence'=>['title'=>'Enemy Intelligence','layout'=>'reports','controls'=>['Open intelligence report'],'actions'=>[],'tables'=>['intelligence_reports']],
 ]],
 'market'=>['label'=>'Market','icon'=>'¤','pages'=>[
   'resource-exchange'=>['title'=>'Resource Exchange','layout'=>'market','controls'=>['List order','Buy order'],'actions'=>['market_list','market_buy'],'tables'=>['market_orders','player_resources']],
   'mercenary-market'=>['title'=>'Mercenary Market','layout'=>'market','controls'=>['Recruit','Sell'],'actions'=>['mercenary_buy'],'tables'=>['mercenary_types','player_mercenaries']],
 ]],
 'social'=>['label'=>'Social','icon'=>'♧','pages'=>[
   'rankings'=>['title'=>'Rankings','layout'=>'rankings','controls'=>['Refresh rankings','Open player'],'actions'=>['refresh_rankings'],'tables'=>['rankings','rank_snapshots']],
   'alliances'=>['title'=>'Alliances','layout'=>'social','controls'=>['Create alliance','Join alliance','Leave alliance'],'actions'=>['alliance_create','alliance_join'],'tables'=>['alliances','alliance_members']],
   'messages'=>['title'=>'Messages','layout'=>'messages','controls'=>['Send','Mark read','Blacklist'],'actions'=>['message','message_read'],'tables'=>['messages','blacklists']],
 ]],
 'planets'=>['label'=>'Planets','icon'=>'○','pages'=>[
   'planet-list'=>['title'=>'Planet List','layout'=>'planets','controls'=>['Explore','Colonize','Upgrade defense'],'actions'=>['explore','combat','colonize_planet','planet_defense'],'tables'=>['player_colonies','planet_bonuses','planet_explorations','player_resources','universe_planets','planet_defenses','motherships','player_cooldowns','game_events']],
   'planet-bonuses'=>['title'=>'Planet Bonuses','layout'=>'planets','controls'=>['View bonuses'],'actions'=>[],'tables'=>['planet_bonuses']],
   'planet-defenses'=>['title'=>'Planet Defenses','layout'=>'planets','controls'=>['Upgrade defense'],'actions'=>['planet_defense'],'tables'=>['planet_defenses']],
 ]],
 'mothership'=>['label'=>'Mothership','icon'=>'△','pages'=>[
   'ship'=>['title'=>'Mothership','layout'=>'ship','controls'=>['Upgrade hull','Upgrade hangars','Upgrade shields'],'actions'=>['mothership_upgrade'],'tables'=>['motherships']],
   'modules'=>['title'=>'Mothership Modules','layout'=>'ship','controls'=>['Upgrade module'],'actions'=>['mothership_upgrade'],'tables'=>['mothership_modules']],
   'exploration'=>['title'=>'Exploration','layout'=>'exploration','controls'=>['Explore planet'],'actions'=>['explore'],'tables'=>['motherships','planet_explorations']],
 ]],
 'account'=>['label'=>'Account','icon'=>'◌','pages'=>[
   'race'=>['title'=>'Race Selection','layout'=>'account','controls'=>['Select race'],'actions'=>['change_race'],'tables'=>['races','players']],
   'vacation'=>['title'=>'Vacation Mode','layout'=>'account','controls'=>['Enable vacation'],'actions'=>['vacation'],'tables'=>['vacation_states','protection_states']],
   'ascension'=>['title'=>'Ascension','layout'=>'progression','controls'=>['Check eligibility','Ascend'],'actions'=>['ascend'],'tables'=>['ascension_states','ascensions','glory_reputation']],
  ]],
 'universe'=>['label'=>'Universe','icon'=>'✦','pages'=>[
   'galaxies'=>['title'=>'Galaxy Map','layout'=>'galaxies','controls'=>['Select galaxy','Open sector'],'actions'=>['universe_galaxies'],'tables'=>['universe_galaxies','universe_sectors','universe_solar_systems','universe_planets','universe_discoveries','target_realms','game_events']],
   'sectors'=>['title'=>'Sector Map','layout'=>'sectors','controls'=>['Select sector','Open system'],'actions'=>['universe_sectors'],'tables'=>['universe_sectors','universe_solar_systems','universe_planets','motherships','mothership_modules','player_technologies','player_cooldowns','game_events']],
   'solar-systems'=>['title'=>'Solar Systems','layout'=>'solar-systems','controls'=>['Open system','Scan system'],'actions'=>['system_map','explore'],'tables'=>['universe_solar_systems','universe_planets']],
   'universe-planets'=>['title'=>'Universe Planets','layout'=>'universe-planets','controls'=>['Inspect planet','Colonize planet'],'actions'=>['planet_details','colonize_planet'],'tables'=>['universe_planets','player_colonies']],
   'moons'=>['title'=>'Moon Registry','layout'=>'moons','controls'=>['Inspect moon','Build jump gate'],'actions'=>['moon_details','mothership_upgrade'],'tables'=>['universe_moons','universe_planets']],
   'coordinates'=>['title'=>'Coordinate Search','layout'=>'coordinates','controls'=>['Search coordinates','Open system'],'actions'=>['coordinate_lookup'],'tables'=>['universe_galaxies','universe_sectors','universe_solar_systems','universe_planets','universe_discoveries','player_colonies']],
  ]],
 ];
