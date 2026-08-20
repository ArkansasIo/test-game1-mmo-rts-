<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/auth.php';
require_auth();
require_once __DIR__ . '/../includes/services/GameService.php';
require_once __DIR__ . '/../includes/services/WeaponMarketService.php';
require_once __DIR__ . '/../includes/services/ResourceMarketService.php';
require_once __DIR__ . '/../includes/services/MercenaryMarketService.php';
require_once __DIR__ . '/../includes/services/RankingsService.php';
require_once __DIR__ . '/../includes/services/AllianceService.php';
require_once __DIR__ . '/../includes/services/MessagingService.php';
require_once __DIR__ . '/../includes/services/PlanetService.php';
require_once __DIR__ . '/../includes/services/PlanetDefenseService.php';
require_once __DIR__ . '/../includes/services/MothershipService.php';
require_once __DIR__ . '/../includes/services/MothershipExplorationService.php';
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
require_once __DIR__ . '/../includes/services/UnitTrainingService.php';
require_once __DIR__ . '/../includes/services/SuperUnitService.php';
require_once __DIR__ . '/../includes/services/UnitProductionService.php';
require_once __DIR__ . '/../includes/services/TechnologyTreeService.php';
require_once __DIR__ . '/../includes/services/OffenseTechnologyService.php';
require_once __DIR__ . '/../includes/services/CovertTechnologyService.php';
require_once __DIR__ . '/../includes/services/AntiCovertTechnologyService.php';
require_once __DIR__ . '/../includes/services/SpyLogService.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('POST required'); }
verify_csrf();
function classify_feedback(Throwable $e): string { $message=strtolower($e->getMessage()); if(str_contains($message,'protected')||str_contains($message,'protection')||str_contains($message,'vacation')) return 'protected'; if(str_contains($message,'cooldown')) return 'cooldown'; if(str_contains($message,'not enough')||str_contains($message,'insufficient')||str_contains($message,'balance')) return 'insufficient-resource'; return $e instanceof InvalidArgumentException ? 'error' : 'error'; }
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
        case 'message_read': if(isset($_POST['message_id'])){$messageResult=(new MessagingService(db()))->markRead((int)$user['id'],(int)$_POST['message_id']);$_SESSION['flash']='Message marked read.';}else{$service->readReport((int)$user['id'],(string)($_POST['report_kind']??'battle'),(int)$_POST['report_id']);$_SESSION['flash']='Report marked read.';} break;
        case 'combat_preview': $_SESSION['combat_preview']=$service->combatPreview((int)$user['id'],(int)$_POST['target_id'],(string)($_POST['combat_type']??'attack'),(int)($_POST['turns']??1)); $_SESSION['flash']='Combat preview refreshed.'; break;
        case 'set_defcon': $service->setDefcon((int)$user['id'],(int)$_POST['level']); $_SESSION['flash']='DefCon status updated.'; break;
        case 'deposit': $service->deposit((int)$user['id'],(int)$_POST['amount']); $_SESSION['flash']='Naquadah deposited.'; break;
        case 'withdraw': $service->withdraw((int)$user['id'],(int)$_POST['amount']); $_SESSION['flash']='Naquadah withdrawn.'; break;
        case 'change_race': $factionResult=(new FactionService(db()))->changeRace((int)$user['id'],(int)$_POST['race_id']); $_SESSION['faction_result']=$factionResult; $_SESSION['flash']='Race changed to '.$factionResult['race'].'.'; break;
        case 'select_registration_faction': $factionResult=(new FactionService(db()))->selectRegistration((int)$user['id'],(int)$_POST['race_id'],(int)$_POST['government_id']); $_SESSION['faction_result']=$factionResult; $_SESSION['flash']='Race and government selected.'; break;
        case 'reform_government': $factionResult=(new FactionService(db()))->reformGovernment((int)$user['id'],(int)$_POST['government_id']); $_SESSION['faction_result']=$factionResult; $_SESSION['flash']='Government reformed to '.$factionResult['government'].'.'; break;
        case 'train': $trainingType=(string)$_POST['type']; if(str_starts_with($trainingType,'super_')){ $elite=(new SuperUnitService(db()))->train((int)$user['id'],$trainingType,(int)$_POST['quantity']); $_SESSION['flash']='Elite deployment completed for '.$elite['quantity'].' '.$elite['unit_key'].' units.'; } else { $training=(new UnitTrainingService(db()))->train((int)$user['id'],$trainingType,(int)$_POST['quantity']); $_SESSION['flash']='Training queued for '.$training['quantity'].' '.$training['unit_key'].' units.'; } break;
        case 'upgrade_up': $production=(new UnitProductionService(db()))->upgrade((int)$user['id']); $_SESSION['flash']='Unit Production upgraded to level '.$production['level_after'].' for '.number_format($production['cost']).' Naquadah.'; break;
        case 'technology': $technologyKey=(string)$_POST['technology_key']; $categoryStmt=db()->prepare('SELECT category FROM technologies WHERE technology_key=?'); $categoryStmt->execute([$technologyKey]); $category=(string)$categoryStmt->fetchColumn(); if($category==='defense'){ $research=(new DefenseTechnologyService(db()))->upgrade((int)$user['id'],$technologyKey); $_SESSION['flash']='Defense research queued to level '.$research['level_after'].' for '.number_format($research['cost']).' Naquadah.'; } elseif($category==='offense'){ $research=(new OffenseTechnologyService(db()))->upgrade((int)$user['id'],$technologyKey); $_SESSION['flash']='Offense research queued to level '.$research['level_after'].' for '.number_format($research['cost']).' Naquadah.'; } elseif($category==='covert'){ $research=(new CovertTechnologyService(db()))->upgrade((int)$user['id'],$technologyKey); $_SESSION['flash']='Covert research queued to level '.$research['level_after'].' for '.number_format($research['cost']).' Naquadah.'; } elseif($category==='anti_covert'){ $research=(new AntiCovertTechnologyService(db()))->upgrade((int)$user['id'],$technologyKey); $_SESSION['flash']='Anti-covert research queued to level '.$research['level_after'].' for '.number_format($research['cost']).' Naquadah.'; } else { $research=(new TechnologyTreeService(db()))->upgrade((int)$user['id'],$technologyKey); $_SESSION['flash']='Research queued to level '.$research['level_after'].' for '.number_format($research['cost']).' Naquadah.'; } break;
        case 'weapon_buy': $service->buyWeapon((int)$user['id'],(int)$_POST['weapon_type_id'],(int)$_POST['quantity']); $_SESSION['flash']='Weapon purchased.'; break;
        case 'weapon_repair': $repair=(new WeaponRepairService(db()))->repair((int)$user['id'],(int)$_POST['weapon_id']); $_SESSION['flash']='Repaired '.$repair['name'].' for '.number_format($repair['repair_cost']).' Naquadah.'; break;
        case 'mothership_upgrade': $upgrade=(new MothershipService(db()))->upgrade((int)$user['id'],(string)$_POST['module']); $_SESSION['mothership_upgrade']=$upgrade; $_SESSION['flash']='Mothership '.$upgrade['module'].' queued to level '.$upgrade['level_after'].' for '.number_format($upgrade['cost']).' Naquadah.'; break;
        case 'combat':
        case 'combat:raid': $combatType=$action==='combat:raid'?'raid':(string)($_POST['combat_type']??'attack'); $result=$service->resolveCombat((int)$user['id'],(int)$_POST['target_id'],$combatType,(int)$_POST['turns']); $_SESSION['flash']='Battle resolved: '.($result['winner_id']===(int)$user['id']?'victory':'defeat').'.'; break;
        case 'covert':
        case 'covert:recon':
        case 'covert:spy':
        case 'covert:sabotage': $missionType=$action==='covert:recon'?'recon':($action==='covert:spy'?'spy':($action==='covert:sabotage'?'sabotage':(string)$_POST['mission_type'])); $result=$service->covertMission((int)$user['id'],(int)$_POST['target_id'],$missionType,(int)$_POST['agents']); $_SESSION['flash']=$result['result']; break;
        case 'explore': if(isset($_POST['universe_planet_id'])){$exploration=(new MothershipExplorationService(db()))->explore((int)$user['id'],(int)$_POST['universe_planet_id']);$_SESSION['mothership_exploration']=$exploration;$_SESSION['flash']='Mothership exploration completed #'.$exploration['exploration_id'].' at '.($exploration['target']??'target').'.';}else{$exploration=(new PlanetService(db()))->explore((int)$user['id'],(string)$_POST['name'],(string)$_POST['planet_type']);$_SESSION['planet_exploration']=$exploration;$_SESSION['flash']='Planet exploration completed #'.$exploration['exploration_id'].'.';} break;
        case 'colonize_planet': $colony=(new PlanetService(db()))->colonize((int)$user['id'],(int)$_POST['planet_id'],(string)$_POST['colony_name']); $_SESSION['planet_colonization']=$colony; $_SESSION['flash']='Colony established #'.$colony['colony_id'].'.'; break;
        case 'planet_defense': $defense=(new PlanetDefenseService(db()))->upgrade((int)$user['id'],(int)$_POST['planet_id'],(string)$_POST['defense_type']); $_SESSION['planet_defense']=$defense; $_SESSION['flash']='Planet defense queued at level '.$defense['level_after'].'.'; break;
        case 'alliance_create': $allianceId=(new AllianceService(db()))->create((int)$user['id'],(string)$_POST['name'],(string)$_POST['tag'],(string)($_POST['description']??'')); $_SESSION['flash']='Alliance created #'.$allianceId.'.'; break;
        case 'alliance_join': $membership=(new AllianceService(db()))->join((int)$user['id'],(int)$_POST['alliance_id']); $_SESSION['flash']='Joined alliance '.$membership['name'].' ('.$membership['member_count'].'/'.$membership['capacity'].').'; break;
        case 'message': $messageId=(new MessagingService(db()))->send((int)$user['id'],(int)$_POST['recipient_id'],(string)$_POST['subject'],(string)$_POST['body']); $_SESSION['flash']='Message sent #'.$messageId.'.'; break;
        case 'market_list': if(isset($_POST['resource_type'])){$orderId=(new ResourceMarketService(db()))->listOrder((int)$user['id'],(string)$_POST['resource_type'],(int)$_POST['quantity'],(int)$_POST['unit_price'],(int)($_POST['expiry_hours']??72));$_SESSION['flash']='Resource market order listed #'.$orderId.'.';}else{$orderId=(new WeaponMarketService(db()))->listWeaponOrder((int)$user['id'],(int)$_POST['weapon_type_id'],(int)$_POST['quantity'],(int)$_POST['unit_price'],(int)($_POST['expiry_hours']??72));$_SESSION['flash']='Weapon market order listed #'.$orderId.'.';} break;
        case 'market_buy': if(isset($_POST['resource_type'])||isset($_POST['resource_market'])){$trade=(new ResourceMarketService(db()))->buyOrder((int)$user['id'],(int)$_POST['order_id'],(int)$_POST['quantity']);$_SESSION['flash']='Purchased '.number_format($trade['quantity']).' '.$trade['resource_type'].' for '.number_format($trade['gross_amount']).' Naquadah; fee '.number_format($trade['fee_amount']).'.';}else{$trade=(new WeaponMarketService(db()))->buyWeaponOrder((int)$user['id'],(int)$_POST['order_id'],(int)$_POST['quantity']);$_SESSION['flash']='Purchased '.number_format($trade['quantity']).' '.$trade['weapon_name'].' for '.number_format($trade['gross_amount']).' Naquadah; fee '.number_format($trade['fee_amount']).'.';} break;
        case 'legacy_message_read': if(isset($_POST['report_id'])){ (new SpyLogService(db()))->markRead((int)$user['id'],(int)$_POST['report_id']); $_SESSION['flash']='Intelligence report marked read.'; } else { (new MessagingService(db()))->markRead((int)$user['id'],(int)$_POST['message_id']); $_SESSION['flash']='Message marked read.'; } break;
        case 'blacklist': (new MessagingService(db()))->blacklist((int)$user['id'],(int)$_POST['blocked_player_id'],(string)($_POST['reason']??'')); $_SESSION['flash']='Player blacklisted.'; break;
        case 'system_map': (new WorldService())->getSystemMap((int)$_POST['system_id']); $_SESSION['flash']='Solar system map loaded.'; break;
        case 'mercenary_buy': $mercenary=(new MercenaryMarketService(db()))->buy((int)$user['id'],(int)$_POST['mercenary_type_id'],(int)$_POST['quantity'],(int)($_POST['duration_days']??1)); $_SESSION['flash']='Recruited '.number_format($mercenary['quantity']).' '.$mercenary['name'].' for '.number_format($mercenary['cost']).' Naquadah.'; break;
        case 'vacation': (new WorldService())->activateVacation((int)$user['id'],(int)$_POST['days']); $_SESSION['flash']='Vacation mode activated.'; break;
        case 'universe_galaxies': (new WorldService())->selectGalaxy((int)$user['id'],(int)$_POST['galaxy_id']); $_SESSION['flash']='Galaxy map loaded.'; break;
        case 'universe_sectors': (new WorldService())->selectSector((int)$user['id'],(int)$_POST['sector_id']); $_SESSION['flash']='Sector map loaded.'; break;
        case 'refresh_rankings': $rankingResult=(new RankingsService(db()))->refresh((int)$user['id']); $_SESSION['rankings']=$rankingResult; $_SESSION['flash']='Rankings refreshed for '.count($rankingResult['rows']).' commanders.'; break;
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
    $readActions=['read_income_breakdown','read_colony_comparison','read_military_stats','read_target_board','read_covert_state','covert_preview','sabotage_preview','combat_preview','read_weapon_inventory','inspect_durability','system_map'];
    $_SESSION['feedback_state']=in_array($action,$readActions,true)?'ready':'success';
    unset($_SESSION['error']);
} catch (Throwable $e) { $_SESSION['feedback_state']=classify_feedback($e); $_SESSION['error']='Action could not be completed.'; $_SESSION['feedback_detail']=$e->getMessage(); }
header('Location: ../index.php?page='.rawurlencode($redirect)); exit;
?>
