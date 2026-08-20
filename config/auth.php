<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('stargatewars_session');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}
function csrf_field(): string { return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">'; }
function verify_csrf(): void {
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        http_response_code(419); exit('Invalid security token. Please reload the page and try again.');
    }
}
function current_user(): ?array { return $_SESSION['user'] ?? null; }
function require_guest(): void { if (current_user()) { header('Location: index.php'); exit; } }
function require_auth(): void { if (!current_user()) { header('Location: login.php'); exit; } }
function route_min_rank(string $route): int {
    return ['sabotage'=>2,'alliances'=>2,'modules'=>2,'ascension'=>3,'planet-conquest'=>2,'black-market'=>2][$route] ?? 1;
}
function can_access_route(string $route): bool { $user = current_user(); return $user && (int)($user['rank_level'] ?? 1) >= route_min_rank($route); }
function require_route_access(string $route): void {
    require_auth();
    if (!can_access_route($route)) { http_response_code(403); exit('Access denied: your current rank does not permit this page.'); }
}
function login_user(array $user): void {
    session_regenerate_id(true);
    $_SESSION['user'] = ['id'=>(int)$user['id'], 'username'=>$user['username'], 'display_name'=>$user['display_name'], 'race'=>$user['race'], 'rank_level'=>(int)($user['rank_level'] ?? 1), 'rank_name'=>$user['rank_name'] ?? 'Initiate'];
}
function logout_user(): void { $_SESSION = []; if (ini_get('session.use_cookies')) { $params = session_get_cookie_params(); setcookie(session_name(), '', time() - 42000, $params['path'], '', (bool)$params['secure'], (bool)$params['httponly']); } session_destroy(); }
?>
