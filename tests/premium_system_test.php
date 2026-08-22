<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../includes/services/PremiumService.php';
$pdo=db(); $playerId=(int)(current_user()['id'] ?? 1); $checks=[]; $fail=0;
$check=function(string $name,bool $ok)use(&$checks,&$fail){$checks[]=['name'=>$name,'passed'=>$ok];if(!$ok)$fail++;};
foreach(['premium_catalog','player_premium','premium_transactions'] as $table){$s=$pdo->prepare('SELECT COUNT(*) FROM information_schema.tables WHERE table_schema=DATABASE() AND table_name=?');$s->execute([$table]);$check($table.' table exists',(int)$s->fetchColumn()===1);}
try{$service=new PremiumService($pdo);$state=$service->state($playerId);$check('premium catalogue loaded',count($state['catalog'])>=5);$check('wallet loaded',isset($state['wallet']['dark_matter']));$check('transaction history scoped',is_array($state['transactions']));}catch(Throwable $e){$check('premium state read',false);}
try{$service->purchase($playerId,'missing_item',1);$check('invalid item rejected',false);}catch(Throwable $e){$check('invalid item rejected',true);}
echo json_encode(['status'=>$fail?'failed':'passed','checks'=>$checks,'failures'=>$fail],JSON_PRETTY_PRINT),PHP_EOL; exit($fail?1:0);
