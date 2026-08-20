<?php
declare(strict_types=1);
$root=dirname(__DIR__);
$registry=require $root.'/config/page_registry.php';
$count=0;
foreach($registry as $groupKey=>$group){
    $subDir=$root.'/pages/'.$groupKey.'/subpages';
    if(!is_dir($subDir)) mkdir($subDir,0775,true);
    foreach(($group['pages']??[]) as $route=>$page){
        $title=(string)($page['title']??ucwords(str_replace('-',' ',$route)));
        $nested="<?php\ndeclare(strict_types=1);\n\$route = ".var_export($route,true).";\n\$group=".var_export($groupKey,true).";\n\$label=".var_export($title,true).";\nrequire __DIR__ . '/../../_nested_entry.php';\n";
        file_put_contents($subDir.'/'.$route.'.php',$nested);
        $rootAlias="<?php\ndeclare(strict_types=1);\n\$route = ".var_export($route,true).";\nrequire __DIR__ . '/_entry.php';\n";
        file_put_contents($root.'/pages/'.$route.'.php',$rootAlias);
        $count++;
    }
}
echo "Generated {$count} canonical nested entries and root aliases.\n";
