<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/services/AdminOverrideService.php';

function auth_bypass_config(): array {
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/auth_bypass.php';
    }
    return $config;
}
function auth_bypass_enabled(): bool {
    $config = auth_bypass_config();
    $environment = strtolower((string)($config['environment'] ?? (getenv('UNIVERSE_ENV') ?: 'production')));
    return ($config['enabled'] ?? false) === true && in_array($environment, ['local', 'development', 'staging'], true);
}
function auth_bypass_user(): ?array {
    if (!auth_bypass_enabled()) return null;
    $config = auth_bypass_config();
    $pdo = db();
    if (!$pdo) return null;
    $stmt = $pdo->prepare('SELECT p.*, r.name AS race FROM players p JOIN races r ON r.id=p.race_id WHERE p.id=? LIMIT 1');
    $stmt->execute([(int)($config['user_id'] ?? 1)]);
    $user = $stmt->fetch();
    return $user ?: null;
}
function auth_bypass_status(): array {
    $config = auth_bypass_config();
    return ['enabled'=>auth_bypass_enabled(), 'configured'=>(bool)($config['enabled'] ?? false), 'environment'=>(string)($config['environment'] ?? (getenv('UNIVERSE_ENV') ?: 'production')), 'user_id'=>(int)($config['user_id'] ?? 1), 'label'=>(string)($config['label'] ?? 'DEVELOPMENT AUTH BYPASS')];
}

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
function admin_override_active(): bool {
    $override = $_SESSION['admin_override'] ?? null;
    if (!is_array($override) || empty($override['expires_at'])) return false;
    try { return new DateTimeImmutable((string)$override['expires_at'], new DateTimeZone('UTC')) > new DateTimeImmutable('now', new DateTimeZone('UTC')); }
    catch (Throwable $e) { return false; }
}
function require_guest(): void { if (current_user()) { header('Location: game.php'); exit; } }
function require_auth(): void {
    if (!current_user() && auth_bypass_enabled()) {
        $user = auth_bypass_user();
        if ($user) login_user($user);
    }
    if (current_user() && isset($_SESSION['admin_override'])) {
        if (!admin_override_active()) { logout_user(); header('Location: login.php?expired=1'); exit; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['admin_override']['scope'] ?? '') === 'read_only_dashboard') {
            $readOnlyActions = ['read_design_catalog','read_formula','read_income_breakdown','read_colony_comparison','read_military_stats','read_target_board','read_covert_state','covert_preview','sabotage_preview','combat_preview','read_weapon_inventory','inspect_durability','read_equipment_catalog','inspect_equipment_design','system_map','planet_details','moon_details','coordinate_lookup','universe_galaxies','universe_sectors','settlement_state'];
            $requestedAction = (string)($_POST['action'] ?? '');
            if (!in_array($requestedAction, $readOnlyActions, true)) {
                http_response_code(403); exit('Administrative read-only override cannot perform mutations.');
            }
        }
    }
    if (!current_user()) { header('Location: login.php'); exit; }
}
function redeem_admin_override(string $rawToken): void {
    $service = new AdminOverrideService(db() ?? throw new RuntimeException('Database unavailable'));
    $user = $service->redeem($rawToken, (string)($_SERVER['HTTP_USER_AGENT'] ?? ''));
    login_user($user);
    $_SESSION['admin_override'] = ['token_id'=>$user['override_token_id'], 'scope'=>$user['override_scope'], 'expires_at'=>$user['override_expires_at']];
}
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
    unset($_SESSION['csrf_token'], $_SESSION['admin_override']);
    $_SESSION['user'] = ['id'=>(int)$user['id'], 'username'=>$user['username'], 'display_name'=>$user['display_name'], 'race'=>$user['race'], 'rank_level'=>(int)($user['rank_level'] ?? 1), 'rank_name'=>$user['rank_name'] ?? 'Initiate'];
}
function logout_user(): void { $_SESSION = []; if (ini_get('session.use_cookies')) { $params = session_get_cookie_params(); setcookie(session_name(), '', time() - 42000, $params['path'], '', (bool)$params['secure'], (bool)$params['httponly']); } session_destroy(); }
?>
