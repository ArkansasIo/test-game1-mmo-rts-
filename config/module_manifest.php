<?php
declare(strict_types=1);
return [
 'Core'=>['path'=>'01_Core','purpose'=>'Configuration, HTTP, PDO, sessions, CSRF, RBAC, and shared application bootstrapping','permission'=>'authenticated'],
 'Gameplay'=>['path'=>'02_Gameplay','purpose'=>'Combat, covert operations, turns, planets, market, mothership, ascension, and universe settlement','permission'=>'authenticated'],
 'Player'=>['path'=>'03_Player','purpose'=>'Authentication, resources, units, weapons, technology, rankings, and player progression','permission'=>'authenticated'],
 'Social'=>['path'=>'04_Social','purpose'=>'Alliances, commanders, officers, recruitment, and messages','permission'=>'authenticated'],
 'Intelligence'=>['path'=>'05_Intelligence','purpose'=>'Spying, sabotage, intelligence reports, and audit-friendly results','permission'=>'ranked'],
 'API'=>['path'=>'06_API','purpose'=>'Thin JSON route adapters that validate input and delegate to services','permission'=>'authenticated'],
 'Database'=>['path'=>'07_Database','purpose'=>'Canonical schema, migrations, seeds, indexes, and read models','permission'=>'deployment'],
 'Cron'=>['path'=>'08_Cron','purpose'=>'Turn settlement, queue completion, fleet arrivals, events, and rankings','permission'=>'worker'],
 'Storage'=>['path'=>'09_Storage','purpose'=>'Application logs, generated reports, and runtime artifacts','permission'=>'runtime'],
 'Docs'=>['path'=>'10_Docs','purpose'=>'Architecture, gameplay rules, data contracts, and operational runbooks','permission'=>'documentation'],
 'Web'=>['path'=>'pages','purpose'=>'Authenticated PHP page entrypoints using the shared front controller','permission'=>'authenticated'],
 'Actions'=>['path'=>'actions','purpose'=>'CSRF-protected POST commands that call transactional services','permission'=>'authenticated'],
 'Assets'=>['path'=>'assets','purpose'=>'Master CSS, module CSS, preview assets, and reference media','permission'=>'public'],
];
