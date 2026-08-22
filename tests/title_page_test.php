<?php
$page=file_get_contents(__DIR__.'/../public-landing.php');$css=file_get_contents(__DIR__.'/../main.css');$passed=0;$failed=0;
function title_check(bool $ok,string $name):void{global $passed,$failed;if($ok){$passed++;echo "PASS: $name\n";}else{$failed++;echo "FAIL: $name\n";}}
title_check(strpos($page,'hero-copy')!==false&&strpos($page,'Build a civilization')!==false&&strpos($page,'persistent text-based science-fiction strategy universe')!==false,'title page contains mission briefing');
title_check(strpos($page,'Nine core resources')!==false&&strpos($page,'Life support matters')!==false&&strpos($page,'Turn-based operations')!==false&&strpos($page,'Server-resolved combat')!==false,'title page explains core game systems');
title_check(strpos($page,'Choose your doctrine')!==false&&strpos($page,'PERSISTENT PROGRESSION')!==false&&strpos($page,'diplomacy')!==false,'title page explains MMO progression systems');
title_check(strpos($page,'SERVER AUTHORITATIVE')!==false&&strpos($page,'GATE CONTROL / ORION EXPANSE')!==false&&strpos($page,'ONLINE')!==false,'title page exposes backend status');
title_check(strpos($page,'href="register.php"')!==false&&strpos($page,'href="login.php"')!==false,'title actions open registration and login flows');
title_check(strpos($page,'STRATEGIC SYSTEMS')!==false&&strpos($page,'COMMAND ECONOMY')!==false&&strpos($page,'REALM IDENTITY')!==false,'title page includes navigable systems and roadmap content');
title_check(strpos($css,'.title-system-grid')!==false&&strpos($css,'.title-roadmap')!==false&&strpos($css,'@media(max-width:600px)')!==false,'title page has responsive industrial-blue styles');
if($failed){fwrite(STDERR,"$failed title-page checks failed; $passed passed.\n");exit(1);}echo "All $passed title-page checks passed.\n";
?>
