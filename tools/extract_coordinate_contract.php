<?php
$game=file_get_contents(__DIR__.'/../game.php');
$start=strpos($game,'function coordinateSearchPage');
$end=strpos($game,'function ', $start+20);
echo "=== game renderer ===\n";
echo substr($game,$start, $end===false?12000:$end-$start);
foreach (['includes/services/WorldService.php','02_Gameplay/WorldService.php','includes/services/NavigationService.php'] as $file) {
    $path=__DIR__.'/../'.$file;
    if (is_file($path)) { echo "\n=== $file ===\n"; $text=file_get_contents($path); foreach (['coordinateLookup','coordinate_lookup'] as $needle) { $pos=strpos($text,$needle); if($pos!==false) echo substr($text,max(0,$pos-300),5000); } }
}
?>
