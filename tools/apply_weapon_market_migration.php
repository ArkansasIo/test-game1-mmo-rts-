<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo = db();
$columns = $pdo->query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='market_orders'")->fetchAll(PDO::FETCH_COLUMN);
if (!in_array('weapon_type_id', $columns, true)) {
    $pdo->exec("ALTER TABLE market_orders ADD COLUMN weapon_type_id INT UNSIGNED NULL AFTER resource_type");
    $pdo->exec("ALTER TABLE market_orders ADD CONSTRAINT fk_market_weapon_type FOREIGN KEY (weapon_type_id) REFERENCES weapon_types(id)");
}
$columns = $pdo->query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='market_orders'")->fetchAll(PDO::FETCH_COLUMN);
if (!in_array('expires_at', $columns, true)) $pdo->exec("ALTER TABLE market_orders ADD COLUMN expires_at DATETIME NULL AFTER status");
$indexes = $pdo->query("SHOW INDEX FROM market_orders")->fetchAll(PDO::FETCH_COLUMN, 2);
if (!in_array('market_weapon_lookup', $indexes, true)) $pdo->exec("ALTER TABLE market_orders ADD INDEX market_weapon_lookup (resource_type, weapon_type_id, status, unit_price)");
$pdo->exec("CREATE TABLE IF NOT EXISTS market_transactions (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, order_id BIGINT UNSIGNED NOT NULL, weapon_type_id INT UNSIGNED NOT NULL, seller_id INT UNSIGNED NOT NULL, buyer_id INT UNSIGNED NOT NULL, quantity INT UNSIGNED NOT NULL, unit_price BIGINT UNSIGNED NOT NULL, gross_amount BIGINT UNSIGNED NOT NULL, fee_amount BIGINT UNSIGNED NOT NULL DEFAULT 0, seller_net BIGINT UNSIGNED NOT NULL, created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, CONSTRAINT fk_market_tx_order FOREIGN KEY (order_id) REFERENCES market_orders(id), CONSTRAINT fk_market_tx_weapon FOREIGN KEY (weapon_type_id) REFERENCES weapon_types(id), CONSTRAINT fk_market_tx_seller FOREIGN KEY (seller_id) REFERENCES players(id), CONSTRAINT fk_market_tx_buyer FOREIGN KEY (buyer_id) REFERENCES players(id), INDEX market_tx_seller (seller_id, created_at), INDEX market_tx_buyer (buyer_id, created_at), INDEX market_tx_weapon (weapon_type_id, created_at)) ENGINE=InnoDB");
echo "weapon_market_migration=applied\n";
