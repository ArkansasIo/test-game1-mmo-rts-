<?php
declare(strict_types=1);

/**
 * Canonical Universe Civilization: Empire at Wars page generator.
 *
 * This wrapper is intentionally small: the page registry and contract catalog
 * remain the sources of truth, while generate_page_tree.php owns the complete
 * filesystem layout and generated PHP artifacts.
 */
$root = dirname(__DIR__);
$generator = $root . '/tools/generate_page_tree.php';
if (!is_file($generator)) {
    throw new RuntimeException('Page-tree generator not found: ' . $generator);
}
require $generator;
