from pathlib import Path
path=Path('/home/ubuntu/stargatewars/register.php')
text=path.read_text()
start=text.index("else try{$stmt=$pdo->prepare('SELECT id FROM races WHERE id=?');")
end=text.index("catch(Throwable $e){", start)
old=text[start:end]
new="""else try {
    $pdo->beginTransaction();
    $stmt=$pdo->prepare('SELECT id FROM races WHERE id=?');
    $stmt->execute([$old['race_id']]);
    if(!$stmt->fetchColumn()) throw new RuntimeException('Selected race is unavailable.');
    $stmt=$pdo->prepare('SELECT id FROM government_types WHERE id=? AND is_active=1');
    $stmt->execute([$old['government_id']]);
    if(!$stmt->fetchColumn()) throw new RuntimeException('Selected government is unavailable.');
    $stmt=$pdo->prepare('INSERT INTO players(username,display_name,password_hash,race_id) VALUES(?,?,?,?)');
    $stmt->execute([$old['username'],$old['display_name'],password_hash($password,PASSWORD_DEFAULT),$old['race_id']]);
    $playerId=(int)$pdo->lastInsertId();
    $pdo->prepare('INSERT INTO player_resources(player_id) VALUES(?)')->execute([$playerId]);
    (new FactionService($pdo))->selectRegistration($playerId,$old['race_id'],$old['government_id']);
    $stmt=$pdo->prepare('SELECT p.*,r.name AS race FROM players p JOIN races r ON r.id=p.race_id WHERE p.id=?');
    $stmt->execute([$playerId]);
    $createdUser=$stmt->fetch(PDO::FETCH_ASSOC);
    if(!$createdUser) throw new RuntimeException('Account initialization failed.');
    $pdo->commit();
    login_user($createdUser);
    header('Location: game.php');
    exit;
} """
path.write_text(text[:start]+new+text[end:])
print('patched registration transaction')
