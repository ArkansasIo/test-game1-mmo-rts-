<?php
declare(strict_types=1);
$root=dirname(__DIR__);
$registry=require $root.'/config/page_registry.php';
$specs=require $root.'/config/page_runtime_specs.php';
$missing=[];$count=0;$layouts=[];
foreach($registry as $group){foreach(($group['pages']??[]) as $route=>$page){$count++;$layout=(string)($page['layout']??'');$layouts[$layout]=true;if(!isset($specs[$layout]))$missing[]='runtime:'.$layout;if($route!=='dashboard'&&!is_file($root.'/pages/'.$route.'.php'))$missing[]='file:'.$route;}}
printf("registered_routes=%d\n",$count);
printf("runtime_layouts=%d\n",count($layouts));
printf("missing=%s\n",$missing?implode(',',$missing):'none');
printf("requested_families=%s\n",implode(',',array_keys($layouts)));
if($missing)exit(1);
