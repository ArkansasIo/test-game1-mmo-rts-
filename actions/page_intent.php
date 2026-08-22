<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/auth.php';
require_auth();
header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new InvalidArgumentException('POST is required.');
    }
    verify_csrf();
    $intent = trim((string)($_POST['intent'] ?? ''));
    $route = trim((string)($_POST['route'] ?? ''));
    $registry = require __DIR__ . '/../config/page_registry.php';
    $page = null;
    $groupKey = null;
    foreach ($registry as $key => $group) {
        if (isset($group['pages'][$route])) {
            $page = $group['pages'][$route];
            $groupKey = $key;
            break;
        }
    }
    if (!$page || !$groupKey) {
        throw new InvalidArgumentException('Unknown page route.');
    }
    if (!in_array($intent, ['inspect_page', 'refresh_page'], true)) {
        throw new InvalidArgumentException('Intent is not permitted for generated pages.');
    }
    echo json_encode([
        'ok' => true,
        'state' => 'ready',
        'intent' => $intent,
        'route' => $route,
        'group' => $groupKey,
        'title' => $page['title'] ?? $route,
        'layout' => $page['layout'] ?? 'generic',
        'controls' => $page['controls'] ?? [],
        'actions' => $page['actions'] ?? [],
        'tables' => $page['tables'] ?? [],
        'message' => $intent === 'refresh_page' ? 'Page state refreshed from the authenticated server context.' : 'Page contract inspected successfully.',
    ], JSON_THROW_ON_ERROR);
} catch (Throwable $e) {
    http_response_code($e instanceof InvalidArgumentException ? 422 : 500);
    echo json_encode(['ok' => false, 'state' => 'error', 'message' => $e->getMessage()], JSON_THROW_ON_ERROR);
}
