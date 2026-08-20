<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/auth.php';
require_auth();
require_once __DIR__ . '/../includes/services/GameService.php';
require_once __DIR__ . '/../includes/services/WeaponMarketService.php';
require_once __DIR__ . '/../includes/services/WorldService.php';
require_once __DIR__ . '/../includes/services/OGameService.php';
require_once __DIR__ . '/../includes/services/MMORPGService.php';
require_once __DIR__ . '/../includes/services/GameFeatureService.php';
require_once __DIR__ . '/../includes/services/EconomyService.php';
require_once __DIR__ . '/../includes/services/FactionService.php';
require_once __DIR__ . '/../includes/services/SocialService.php';
require_once __DIR__ . '/../includes/services/ProgressionService.php';
require_once __DIR__ . '/../includes/services/DefenseTechnologyService.php';
require_once __DIR__ . '/../includes/services/WeaponRepairService.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('POST required'); }
verify_csrf();
$user=current_user(); $service=new GameService(); $action=(string)($_POST['action']??''); $requestedRedirect=(string)($_POST['redirect']??'dashboard'); $allowedRedirects=['dashboard','resources','income','military-stats','account-info','race','units','miners','unit-production','technology','targets','spy','sabotage','attack-log','weapons','weapon-market','repair','mothership','ship','modules','planet-list','planet-bonuses','planet-defenses','exploration','alliances','messages','resource-exchange','mercenary-market','rankings','vacation','ascension','colonies','food-water','population','resource-buildings','life-support','shipyard','defense-grid','research','navigation','energy','fleet-overview','missions','mission-log','events','event-history','galaxies','sectors','solar-systems','universe-planets','moons','coordinates']; $redirect=in_array($requestedRedirect,$allowedRedirects,true)?$requestedRedirect:'dashboard';
try {
    switch ($action) {
        case 'process_turns': $result=$service->processTurns((int)$user['id']); $_SESSION['flash']='Processed '.$result['turns'].' turns and generated '.number_format($result['income']).' Naquadah.'; break;
        case 'read_income_breakdown': $result=(new EconomyService(db()))->incomeBreakdown((int)$user['id']); $_SESSION['income_breakdown']=$result; $_SESSION['flash']='Income breakdown refreshed.'; break;
        case 'read_colony_comparison': $result=(new EconomyService(db()))->colonyComparison((int)$user['id']); $_SESSION['colony_comparison']=$result; $_SESSION['flash']='Colony comparison refreshed for '.count($result).' colonies.'; break;
        case 'progression_advance': $progress=(new ProgressionService(db()))->advance((int)$user['id'],trim((string)$_POST['entity_category']),trim((string)$_POST['entity_key'])); $_SESSION['flash']='Progression advanced to Tier '.$progress['tier_after'].' / Level '.$progress['level_after'].'.'; break;
        case 'read_military_stats': $_SESSION['military_stats']=$service->militaryStats((int)$user['id']); $_SESSION['flash']='Military statistics refreshed.'; break;
        case 'read_target_board': $_SESSION['target_board']=$service->targetBoard((int)$user['id']); $_SESSION['flash']='Target board refreshed.'; break;
        case 'read_covert_state': $_SESSION['covert_state']=$service->covertStats((int)$user['id']); $_SESSION['flash']='Covert agent state refreshed.'; break;
        case 'covert_preview': $_SESSION['covert_preview']=$service->covertPreview((int)$user['id'],(int)$_POST['target_id'],(int)$_POST['agents'],(string)($_POST['mission_type']??'spy')); $_SESSION['flash']='Covert detection preview refreshed.'; break;
        case 'sabotage_preview': $_SESSION['sabotage_preview']=$service->covertPreview((int)$user['id'],(int)$_POST['target_id'],(int)$_POST['agents'],'sabotage'); $_SESSION['flash']='Sabotage damage preview refreshed.'; break;
        case 'read_report': $service->readReport((int)$user['id'],(string)($_POST['report_kind']??'battle'),(int)$_POST['report_id']); $_SESSION['flash']='Report opened and ownership verified.'; break;
        case 'read_weapon_inventory': $_SESSION['weapons']=$service->weaponInventory((int)$user['id']); $_SESSION['flash']='Weapon inventory refreshed.'; break;
        case 'inspect_durability': $_SESSION['weapons']=$service->weaponInventory((int)$user['id']); $_SESSION['flash']='Weapon durability inspected.'; break;
        case 'message_read': $service->readReport((int)$user['id'],(string)($_POST['report_kind']??'battle'),(int)$_POST['report_id']); $_SESSION['flash']='Report marked read.'; break;
        case 'combat_preview': $_SESSION['combat_preview']=$service->combatPreview((int)$user['id'],(int)$_POST['target_id'],(string)($_POST['combat_type']??'attack'),(int)($_POST['turns']??1)); $_SESSION['flash']='Combat preview refreshed.'; break;
        case 'set_defcon': $service->setDefcon((int)$user['id'],(int)$_POST['level']); $_SESSION['flash']='DefCon status updated.'; break;
        case 'deposit': $service->deposit((int)$user['id'],(int)$_POST['amount']); $_SESSION['flash']='Naquadah deposited.'; break;
        case 'withdraw': $service->withdraw((int)$user['id'],(int)$_POST['amount']); $_SESSION['flash']='Naquadah withdrawn.'; break;
        case 'change_race': $service->changeRace((int)$user['id'],(int)$_POST['race_id']); $_SESSION['flash']='Race changed.'; break;
        case 'select_registration_faction': (new FactionService(db()))->selectRegistration((int)$user['id'],(int)$_POST['race_id'],(int)$_POST['government_id']); $_SESSION['flash']='Race and government selected.'; break;
        case 'reform_government': (new FactionService(db()))->reformGovernment((int)$user['id'],(int)$_POST['government_id']); $_SESSION['flash']='Government reformed.'; break;
        case 'train': $service->train((int)$user['id'],(string)$_POST['type'],(int)$_POST['quantity']); $_SESSION['flash']='Training completed.'; break;
        case 'upgrade_up': $cost=$service->upgradeUnitProduction((int)$user['id']); $_SESSION['flash']='Unit Production upgraded for '.number_format($cost).' Naquadah.'; break;
        case 'technology': $technologyKey=(string)$_POST['technology_key']; $categoryStmt=db()->prepare('SELECT category FROM technologies WHERE technology_key=?'); $categoryStmt->execute([$technologyKey]); $category=(string)$categoryStmt->fetchColumn(); if($category==='defense'){ $research=(new DefenseTechnologyService(db()))->upgrade((int)$user['id'],$technologyKey); $_SESSION['flash']='Defense research queued to level '.$research['level_after'].' for '.number_format($research['cost']).' Naquadah.'; } else { $cost=$service->buyTechnology((int)$user['id'],$technologyKey); $_SESSION['flash']='Technology upgraded for '.number_format($cost).' Naquadah.'; } break;
        case 'weapon_buy': $service->buyWeapon((int)$user['id'],(int)$_POST['weapon_type_id'],(int)$_POST['quantity']); $_SESSION['flash']='Weapon purchased.'; break;
        case 'weapon_repair': $repair=(new WeaponRepairService(db()))->repair((int)$user['id'],(int)$_POST['weapon_id']); $_SESSION['flash']='Repaired '.$repair['name'].' for '.number_format($repair['repair_cost']).' Naquadah.'; break;
        case 'mothership_upgrade': $cost=$service->upgradeMothership((int)$user['id'],(string)$_POST['module']); $_SESSION['flash']='Mothership upgraded for '.number_format($cost).' Naquadah.'; break;
        case 'combat':
        case 'combat:raid': $combatType=$action==='combat:raid'?'raid':(string)($_POST['combat_type']??'attack'); $result=$service->resolveCombat((int)$user['id'],(int)$_POST['target_id'],$combatType,(int)$_POST['turns']); $_SESSION['flash']='Battle resolved: '.($result['winner_id']===(int)$user['id']?'victory':'defeat').'.'; break;
        case 'covert':
        case 'covert:recon':
        case 'covert:spy':
        case 'covert:sabotage': $missionType=$action==='covert:recon'?'recon':($action==='covert:spy'?'spy':($action==='covert:sabotage'?'sabotage':(string)$_POST['mission_type'])); $result=$service->covertMission((int)$user['id'],(int)$_POST['target_id'],$missionType,(int)$_POST['agents']); $_SESSION['flash']=$result['result']; break;
        case 'explore': (new WorldService())->explore((int)$user['id'],trim((string)$_POST['name']),trim((string)$_POST['planet_type'])); $_SESSION['flash']='Planet exploration completed.'; break;
        case 'colonize_planet': $colonyId=(new WorldService())->colonizePlanet((int)$user['id'],(int)$_POST['planet_id'],trim((string)$_POST['colony_name'])); $_SESSION['flash']='Colony established #'.$colonyId.'.'; break;
        case 'planet_defense': (new WorldService())->upgradePlanetDefense((int)$user['id'],(int)$_POST['planet_id'],(string)$_POST['defense_type']); $_SESSION['flash']='Planet defense upgraded.'; break;
        case 'alliance_create': (new WorldService())->createAlliance((int)$user['id'],trim((string)$_POST['name']),trim((string)$_POST['tag']),trim((string)$_POST['description'])); $_SESSION['flash']='Alliance created.'; break;
        case 'alliance_join': (new WorldService())->joinAlliance((int)$user['id'],(int)$_POST['alliance_id']); $_SESSION['flash']='Joined alliance.'; break;
        case 'message': (new WorldService())->sendMessage((int)$user['id'],(int)$_POST['recipient_id'],trim((string)$_POST['subject']),trim((string)$_POST['body'])); $_SESSION['flash']='Message sent.'; break;
        case 'market_list': $orderId=(new WeaponMarketService(db()))->listWeaponOrder((int)$user['id'],(int)$_POST['weapon_type_id'],(int)$_POST['quantity'],(int)$_POST['unit_price'],(int)($_POST['expiry_hours']??72)); $_SESSION['flash']='Weapon market order listed #'.$orderId.'.'; break;
        case 'market_buy': $trade=(new WeaponMarketService(db()))->buyWeaponOrder((int)$user['id'],(int)$_POST['order_id'],(int)$_POST['quantity']); $_SESSION['flash']='Purchased '.number_format($trade['quantity']).' '.$trade['weapon_name'].' for '.number_format($trade['gross_amount']).' Naquadah; fee '.number_format($trade['fee_amount']).'.'; break;
        case 'message_read': (new WorldService())->markMessageRead((int)$user['id'],(int)$_POST['message_id']); $_SESSION['flash']='Message marked read.'; break;
        case 'blacklist': (new SocialService(db()))->blacklist((int)$user['id'],(int)$_POST['blocked_player_id'],(string)($_POST['reason']??'')); $_SESSION['flash']='Player blacklisted.'; break;
        case 'system_map': (new WorldService())->getSystemMap((int)$_POST['system_id']); $_SESSION['flash']='Solar system map loaded.'; break;
        case 'mercenary_buy': (new WorldService())->buyMercenary((int)$user['id'],(int)$_POST['mercenary_type_id'],(int)$_POST['quantity']); $_SESSION['flash']='Mercenaries recruited.'; break;
        case 'vacation': (new WorldService())->activateVacation((int)$user['id'],(int)$_POST['days']); $_SESSION['flash']='Vacation mode activated.'; break;
        case 'refresh_rankings': (new WorldService())->refreshRanking(); $_SESSION['flash']='Rankings refreshed.'; break;
        case 'ascend': (new WorldService())->ascend((int)$user['id'],trim((string)$_POST['ascended_race'])); $_SESSION['flash']='Ascension completed.'; break;
        case 'colony_turn': (new OGameService(db()))->processColonyTurn((int)$user['id'],(int)$_POST['colony_id'],(int)($_POST['elapsed_seconds']??3600)); $_SESSION['flash']='Colony turn processed.'; break;
        case 'queue_building': $queueId=(new OGameService(db()))->queueBuilding((int)$user['id'],(int)$_POST['colony_id'],trim((string)$_POST['building_key']),(int)$_POST['level']); $_SESSION['flash']='Building queued #'.$queueId.'.'; break;
        case 'queue_research': $queueId=(new GameFeatureService(db()))->queueResearch((int)$user['id'],(int)$_POST['colony_id'],trim((string)$_POST['technology_key']),(int)$_POST['level'],(int)$_POST['seconds']); $_SESSION['flash']='Research queued #'.$queueId.'.'; break;
        case 'event_join': (new GameFeatureService(db()))->joinWorldEvent((int)$user['id'],(int)$_POST['event_id']); $_SESSION['flash']='Joined world event.'; break;
        case 'record_discovery': $discoveryId=(new GameFeatureService(db()))->recordDiscovery((int)$user['id'],trim((string)$_POST['discovery_key']),trim((string)$_POST['discovery_type']),isset($_POST['system_id'])?(int)$_POST['system_id']:null,isset($_POST['planet_id'])?(int)$_POST['planet_id']:null,is_array($_POST['payload']??null)?$_POST['payload']:[]); $_SESSION['flash']='Discovery recorded #'.$discoveryId.'.'; break;
        case 'launch_mission': $missionId=(new OGameService(db()))->launchMission((int)$user['id'],(int)$_POST['source_colony_id'],isset($_POST['target_colony_id'])?(int)$_POST['target_colony_id']:null,trim((string)$_POST['mission_type']),is_array($_POST['payload']??null)?$_POST['payload']:[],(int)$_POST['travel_seconds']); $_SESSION['flash']='Fleet mission launched #'.$missionId.'.'; break;
        case 'add_experience': $progress=(new MMORPGService(db()))->addExperience((int)$user['id'],(int)$_POST['amount']); $_SESSION['flash']='Progression updated to level '.$progress['level'].'.'; break;
        case 'diplomacy_propose': $id=(new MMORPGService(db()))->proposeDiplomacy((int)$_POST['world_id'],(int)$user['id'],(int)$_POST['target_player_id'],trim((string)$_POST['relation_type'])); $_SESSION['flash']='Diplomatic proposal created #'.$id.'.'; break;
        case 'trade_create': $id=(new MMORPGService(db()))->createTrade((int)$_POST['world_id'],(int)$user['id'],(int)$_POST['buyer_player_id'],trim((string)$_POST['resource_key']),(int)$_POST['quantity'],(int)$_POST['unit_price']); $_SESSION['flash']='Trade contract created #'.$id.'.'; break;
        case 'notification_read': db()->prepare('UPDATE player_notifications SET is_read=1 WHERE id=? AND player_id=?')->execute([(int)$_POST['notification_id'],(int)$user['id']]); $_SESSION['flash']='Notification marked read.'; break;
        default: throw new InvalidArgumentException('Unknown game action');
    }
} catch (Throwable $e) { $_SESSION['error']=$e->getMessage(); }
header('Location: ../index.php?page='.rawurlencode($redirect)); exit;
?>
