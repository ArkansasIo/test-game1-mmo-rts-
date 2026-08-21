<?php
declare(strict_types=1);
require_once __DIR__ . '/config/auth.php';

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Referrer-Policy: no-referrer');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Administrative override redemption requires a POST request.');
}

$token = (string)($_POST['token'] ?? '');
try {
    redeem_admin_override($token);
    header('Location: game.php', true, 303);
    exit;
} catch (Throwable $e) {
    http_response_code(403);
    exit('Administrative override token is invalid, expired, revoked, or already used.');
}
