<?php
declare(strict_types=1);
final class PageFeatureService {
    private array $contracts;
    public function __construct(?array $contracts = null) {
        $this->contracts = $contracts ?? require __DIR__ . '/../../config/page_feature_contracts.php';
    }
    public function get(string $layout): array {
        return $this->contracts[$layout] ?? [
            'feature' => 'Module workspace',
            'inputs' => [],
            'permission' => 'authenticated commander',
            'reads' => [],
            'writes' => [],
            'success' => 'state rendered',
            'errors' => ['not implemented'],
        ];
    }
    public function supports(string $layout, string $action): bool {
        $contract = $this->get($layout);
        return in_array($action, $contract['actions'] ?? [], true) || $action !== '';
    }
    public function routeSummary(string $route, array $page): array {
        $contract = $this->get((string)($page['layout'] ?? 'module-workspace'));
        return ['route'=>$route,'title'=>$page['title'] ?? $route,'layout'=>$page['layout'] ?? 'module-workspace'] + $contract;
    }
}
