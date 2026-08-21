<?php
require_once __DIR__ . '/config/auth.php';
require_guest();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $pdo = db();
    if ($pdo && $username !== '' && $password !== '') {
        $stmt = $pdo->prepare("SELECT p.*, r.name AS race FROM players p JOIN races r ON r.id=p.race_id WHERE p.username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password_hash'])) { login_user($user); header('Location: index.php'); exit; }
    }
    $error = 'The username or password is incorrect.';
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Log in · Universe Civilization: Empire at Wars</title><link rel="stylesheet" href="assets/app.css"></head><body class="auth-page"><main class="auth-card"><div class="brand auth-brand"><div class="brand-mark">S</div><div><strong>UNIVERSE CIVILIZATION: EMPIRE AT WARS</strong><small>COMMAND INTERFACE</small></div></div><p class="kicker">SECURE ACCESS</p><h1>Log in to your realm</h1><p class="auth-copy">Enter your commander credentials to continue.</p><?php if ($error): ?><div class="error-box"><?= e($error) ?></div><?php endif; ?><form method="post"><?= csrf_field() ?><label>Username<input name="username" required autocomplete="username"></label><label>Password<input type="password" name="password" required autocomplete="current-password"></label><button class="button dark" type="submit">Log in <span>→</span></button></form><p class="auth-foot">New commander? <a href="register.php">Create an account</a></p></main></body></html>
