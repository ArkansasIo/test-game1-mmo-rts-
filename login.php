<?php
require_once __DIR__ . '/config/auth.php';
require_guest();
$appMeta = require __DIR__ . '/config/app_meta.php';
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
        $passwordValid = $user && password_verify($password, (string)$user['password_hash']);
        $legacyHashValid = $user && preg_match('/^[a-f0-9]{64}$/i', (string)$user['password_hash']) === 1 && hash_equals(strtolower((string)$user['password_hash']), hash('sha256', $password));
        if ($user && ($passwordValid || $legacyHashValid)) {
            if ($legacyHashValid) {
                $rehash = $pdo->prepare('UPDATE players SET password_hash=? WHERE id=?');
                $rehash->execute([password_hash($password, PASSWORD_DEFAULT), (int)$user['id']]);
            }
            login_user($user);
            header('Location: game.php');
            exit;
        }
    }
    $error = 'The username or password is incorrect.';
}
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Secure Access · <?=e($appMeta['name'])?></title>
<link rel="stylesheet" href="assets/app.css">
<style>
:root{--ink:#0b0d0e;--paper:#f4f6f5;--cyan:#00c8e6;--cyan-dark:#007d91;--line:#cbd3d4;--muted:#5b6669;--danger:#a62222}
*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,sans-serif}.auth-page{min-height:100vh;display:grid;place-items:center;padding:28px;position:relative;overflow:hidden}.auth-page:before{content:'';position:fixed;inset:0;pointer-events:none;opacity:.35;background:linear-gradient(rgba(0,200,230,.08) 1px,transparent 1px),linear-gradient(90deg,rgba(0,200,230,.08) 1px,transparent 1px);background-size:32px 32px}.access-shell{position:relative;z-index:1;width:min(1080px,100%);display:grid;grid-template-columns:1.08fr .92fr;background:#fff;border:1px solid var(--ink);box-shadow:14px 14px 0 var(--ink)}.access-brief{padding:48px;background:var(--ink);color:#fff;min-height:640px;display:flex;flex-direction:column;justify-content:space-between}.brand{display:flex;align-items:center;gap:12px}.brand-mark{width:44px;height:44px;display:grid;place-items:center;background:var(--cyan);color:var(--ink);font-weight:950;font-size:22px;border:1px solid #fff}.brand strong{display:block;font-size:12px;letter-spacing:.12em;line-height:1.35}.brand small{display:block;color:#8ca0a4;font-size:9px;letter-spacing:.18em;margin-top:4px}.brief-copy{max-width:470px}.eyebrow{font-size:10px;letter-spacing:.2em;font-weight:900;color:var(--cyan)}.brief-copy h1{font-size:clamp(40px,6vw,72px);line-height:.9;letter-spacing:-.08em;margin:18px 0 24px}.brief-copy h1 span{display:block;color:#91a1a4}.brief-copy p{color:#b5c0c2;line-height:1.7;max-width:440px}.telemetry{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}.telemetry div{border:1px solid #39474a;padding:14px}.telemetry b{display:block;color:var(--cyan);font:800 18px ui-monospace,monospace}.telemetry small{display:block;color:#9eacad;font-size:9px;letter-spacing:.1em;text-transform:uppercase;margin-top:4px}.access-panel{padding:48px;display:flex;flex-direction:column;justify-content:center}.panel-top{display:flex;justify-content:space-between;align-items:start;gap:14px;margin-bottom:34px}.panel-top h2{font-size:32px;letter-spacing:-.06em;margin:7px 0}.status-chip{border:1px solid var(--cyan-dark);color:var(--cyan-dark);font:800 10px ui-monospace,monospace;padding:7px 9px;white-space:nowrap}.auth-copy{color:var(--muted);line-height:1.6;margin-top:0}.error-box{border:1px solid var(--danger);background:#fff4f4;color:var(--danger);padding:12px;margin:18px 0;font-size:13px}.field{display:block;margin:18px 0}.field span{display:flex;justify-content:space-between;font:900 10px ui-monospace,monospace;letter-spacing:.12em;text-transform:uppercase;margin-bottom:8px}.field input{width:100%;border:1px solid #9aa8aa;background:#fbfcfc;padding:14px 13px;font:500 15px ui-monospace,monospace;color:var(--ink)}.field input:focus{outline:2px solid var(--cyan);outline-offset:2px;border-color:var(--ink)}.button{border:1px solid var(--ink);padding:14px 16px;text-decoration:none;font-weight:900;font-size:12px;letter-spacing:.08em;cursor:pointer}.button.dark{background:var(--ink);color:#fff;width:100%;margin-top:8px}.button.dark:hover{background:var(--cyan);color:var(--ink)}.auth-foot{border-top:1px solid var(--line);padding-top:20px;color:var(--muted);font-size:13px;margin-top:32px}.auth-foot a{color:var(--cyan-dark);font-weight:800}.legal{font-size:10px;color:var(--muted);line-height:1.5;margin-top:26px}.legal a{color:inherit}@media(max-width:760px){.auth-page{padding:14px}.access-shell{grid-template-columns:1fr;box-shadow:7px 7px 0 var(--ink)}.access-brief{min-height:auto;padding:28px}.brief-copy{margin:55px 0 42px}.brief-copy h1{font-size:clamp(42px,14vw,64px)}.access-panel{padding:30px 24px}.telemetry{grid-template-columns:repeat(3,1fr)}}@media(max-width:420px){.auth-page{padding:8px}.access-brief,.access-panel{padding:22px 18px}.telemetry{grid-template-columns:1fr}.telemetry div{display:flex;justify-content:space-between;align-items:center}.telemetry b{font-size:15px}.panel-top{display:block}.status-chip{display:inline-block;margin-top:10px}}
html[data-theme=deep-space-blue]{--ink:#E8FBFF;--paper:#0E2A40;--cyan:#357EC7;--cyan-dark:#D8ECFF;--line:#357EC7;--muted:#A8D3E0;--danger:#FF6D8F}html[data-theme=deep-space-blue] body{background:#0E2A40;color:#E8FBFF}html[data-theme=deep-space-blue] .access-shell,html[data-theme=deep-space-blue] .access-panel{background:#16405C;color:#E8FBFF;border-color:#357EC7}html[data-theme=deep-space-blue] .access-brief{background:#0E2A40;color:#E8FBFF}html[data-theme=deep-space-blue] .field input,html[data-theme=deep-space-blue] .button{background:#1D5875;color:#E8FBFF;border-color:#357EC7}html[data-theme=deep-space-blue] .button.dark{background:linear-gradient(180deg,#357EC7,#1F5FA8);color:#E8FBFF}html[data-theme=deep-space-blue] .auth-copy,html[data-theme=deep-space-blue] .legal,html[data-theme=deep-space-blue] .auth-foot{color:#A8D3E0}html[data-theme=deep-space-blue] .eyebrow,html[data-theme=deep-space-blue] .auth-foot a,html[data-theme=deep-space-blue] .legal a{color:#D8ECFF}html[data-theme=deep-space-blue] .status-chip{color:#357EC7;border-color:#357EC7}html[data-theme=window-blue] body{background:#061018;color:#e7f7ff}html[data-theme=window-blue] .access-shell,html[data-theme=window-blue] .access-panel{background:#08151e;color:#e7f7ff;border-color:#285064}html[data-theme=window-blue] .access-brief{background:#030a10;color:#e7f7ff}html[data-theme=window-blue] .field input,html[data-theme=window-blue] .button,html[data-theme=window-blue] .auth-card a{background:#0b1d28;color:#e7f7ff;border-color:#4ddcff}html[data-theme=window-blue] .button.dark{background:#123b4c;color:#fff}html[data-theme=window-blue] .muted,html[data-theme=window-blue] .auth-copy,html[data-theme=window-blue] .legal,html[data-theme=window-blue] .auth-foot{color:#9ab5c1}html[data-theme=window-blue] .eyebrow,html[data-theme=window-blue] .auth-foot a,html[data-theme=window-blue] .legal a{color:#4ddcff}html[data-theme=window-blue] .status-chip{color:#4ddcff;border-color:#4ddcff}</style>
</head>
<body class="auth-page">
<main class="access-shell">
<section class="access-brief" aria-labelledby="access-title">
  <div class="brand"><div class="brand-mark">U</div><div><strong><?=e(strtoupper($appMeta['name']))?></strong><small>SECURE COMMAND NETWORK</small></div></div>
  <div class="brief-copy"><div class="eyebrow">GATEWAY 01 / AUTHENTICATED ENTRY</div><h1 id="access-title">Return to the <span>command layer.</span></h1><p>Every colony, fleet, research queue, and diplomatic decision is waiting inside your persistent realm. Authenticate to resume server-authoritative operations.</p></div>
  <div class="telemetry" aria-label="Network status"><div><b>01</b><small>Active realm</small></div><div><b>8</b><small>Resources</small></div><div><b>21</b><small>Tier ladder</small></div></div>
</section>
<section class="access-panel" aria-labelledby="login-heading">
  <div class="panel-top"><div><div class="eyebrow">COMMANDER CREDENTIALS</div><h2 id="login-heading">Secure access</h2></div><span class="status-chip">TLS / READY</span></div>
  <p class="auth-copy">Enter your commander credentials to continue to the Universe Civilization control surface.</p>
  <?php if ($error): ?><div class="error-box" role="alert"><?=e($error)?></div><?php endif; ?>
  <form method="post" autocomplete="on">
    <?=csrf_field()?>
    <label class="field"><span>Username <small>IDENTITY</small></span><input name="username" required autocomplete="username" autofocus></label>
    <label class="field"><span>Password <small>SECRET</small></span><input type="password" name="password" required autocomplete="current-password"></label>
    <button class="button dark" type="submit">Authenticate commander <span aria-hidden="true">→</span></button>
  </form>
  <p class="auth-foot">New commander? <a href="register.php">Create a realm</a></p>
  <p class="legal">Server-side validation, CSRF protection, and session authentication are required for every command. <a href="public-landing.php">Return to title page</a>.</p>
</section>
</main>
<script>document.documentElement.dataset.theme=['window-blue','deep-space-blue'].includes(localStorage.getItem('sgw_theme'))?localStorage.getItem('sgw_theme'):'default-white';</script></body>
</html>
