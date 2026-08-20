<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$manifest = require $root . '/config/page_registry.php';
$routes = [];
foreach ($manifest as $group) {
    foreach (($group['pages'] ?? []) as $route => $_definition) {
        $routes[] = $route;
    }
}
$routes = array_values(array_unique($routes));
$baseUrl = getenv('STARGATE_BASE_URL') ?: 'http://127.0.0.1:8095';
$rounds = max(1, (int)(getenv('STRESS_ROUNDS') ?: 5));
$batchSize = max(1, (int)(getenv('STRESS_CONCURRENCY') ?: 24));
$requests = [];
for ($round = 0; $round < $rounds; $round++) {
    foreach ($routes as $route) {
        $requests[] = ['kind' => 'central', 'route' => $route, 'url' => $baseUrl . '/index.php?page=' . rawurlencode($route)];
        $requests[] = ['kind' => 'nested', 'route' => $route, 'url' => $baseUrl . '/pages/' . ($manifest[array_key_first(array_filter($manifest, static fn(array $g): bool => isset($g['pages'][$route])))]['pages'][$route]['path'] ?? '')];
    }
}
// Resolve nested paths from the canonical folder structure instead of relying on optional registry path fields.
foreach ($requests as &$request) {
    if ($request['kind'] === 'nested') {
        $groupKey = null;
        foreach ($manifest as $candidateGroup => $group) {
            if (isset($group['pages'][$request['route']])) { $groupKey = $candidateGroup; break; }
        }
        $request['url'] = $baseUrl . '/pages/' . $groupKey . '/subpages/' . $request['route'] . '.php';
    }
}
unset($request);

$results = [];
$started = microtime(true);
foreach (array_chunk($requests, $batchSize) as $batch) {
    $multi = curl_multi_init();
    $handles = [];
    foreach ($batch as $request) {
        $handle = curl_init($request['url']);
        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_CONNECTTIMEOUT_MS => 1000,
            CURLOPT_TIMEOUT_MS => 5000,
            CURLOPT_HTTPHEADER => ['Accept: text/html'],
        ]);
        curl_multi_add_handle($multi, $handle);
        $handles[(int)$handle] = [$handle, $request, microtime(true)];
    }
    do {
        $status = curl_multi_exec($multi, $running);
        if ($running > 0) { curl_multi_select($multi, 0.2); }
    } while ($running > 0 && $status === CURLM_OK);
    foreach ($handles as [$handle, $request, $requestStarted]) {
        $results[] = [
            'kind' => $request['kind'],
            'route' => $request['route'],
            'status' => (int)curl_getinfo($handle, CURLINFO_HTTP_CODE),
            'time_ms' => round((microtime(true) - $requestStarted) * 1000, 2),
            'error' => curl_error($handle),
        ];
        curl_multi_remove_handle($multi, $handle);
        curl_close($handle);
    }
    curl_multi_close($multi);
}
$total = count($results);
$times = array_column($results, 'time_ms');
sort($times);
$percentile = static function (array $values, float $p): float {
    if ($values === []) return 0.0;
    $index = (int)floor((count($values) - 1) * $p);
    return (float)$values[$index];
};
$ok = array_values(array_filter($results, static fn(array $r): bool => in_array($r['status'], [200, 302], true) && $r['error'] === ''));
$errors = array_values(array_filter($results, static fn(array $r): bool => !in_array($r['status'], [200, 302], true) || $r['error'] !== ''));
$statusCounts = [];
foreach ($results as $result) { $statusCounts[(string)$result['status']] = ($statusCounts[(string)$result['status']] ?? 0) + 1; }
$elapsed = max(0.001, microtime(true) - $started);
$output = [
    'status' => $errors === [] ? 'passed' : 'failed',
    'base_url' => $baseUrl,
    'routes' => count($routes),
    'rounds' => $rounds,
    'concurrency_batch' => $batchSize,
    'requests' => $total,
    'successful_requests' => count($ok),
    'failed_requests' => count($errors),
    'throughput_requests_per_second' => round($total / $elapsed, 2),
    'latency_ms' => ['p50' => $percentile($times, 0.50), 'p95' => $percentile($times, 0.95), 'max' => $times === [] ? 0 : max($times)],
    'status_counts' => $statusCounts,
    'sample_errors' => array_slice($errors, 0, 10),
];
echo json_encode($output, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR) . PHP_EOL;
exit($errors === [] ? 0 : 1);
