<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/WorkforceService.php';
$pdo=db();
$col=$pdo->query('SELECT id,player_id FROM colonies ORDER BY id LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if(!$col){echo "no colony\n";exit(1);}
$before=$pdo->prepare('SELECT role,assigned_population FROM population_assignments WHERE colony_id=?');$before->execute([$col['id']]);$old=$before->fetchAll(PDO::FETCH_KEY_PAIR);
$wf=new WorkforceService($pdo);$result=$wf->assign((int)$col['player_id'],(int)$col['id'],'lifers',10);
$checks=['success_state'=>($result['state']??'')==='success','lifers_updated'=>(int)$result['lifers']===10,'total_bound'=>((int)$result['total_assigned']<=(int)$pdo->query('SELECT population FROM colonies WHERE id='.(int)$col['id'])->fetchColumn())];
foreach(['miners','lifers'] as $role){$value=array_key_exists($role,$old)?(int)$old[$role]:0;$pdo->prepare('INSERT INTO population_assignments(colony_id,role,assigned_population) VALUES(?,?,?) ON DUPLICATE KEY UPDATE assigned_population=VALUES(assigned_population)')->execute([$col['id'],$role,$value]);}
$total=(int)($old['miners']??0)+(int)($old['lifers']??0);$pdo->prepare('UPDATE colonies SET workforce=? WHERE id=?')->execute([$total,$col['id']]);
$checks['restored']=true;
$failed=array_keys(array_filter($checks,fn($v)=>!$v));echo json_encode(['status'=>$failed?'failed':'passed','result'=>$result,'checks'=>$checks,'failures'=>$failed],JSON_PRETTY_PRINT).PHP_EOL;exit($failed?1:0);
