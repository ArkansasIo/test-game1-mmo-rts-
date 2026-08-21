CREATE TABLE IF NOT EXISTS admin_override_tokens (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  token_hash CHAR(64) NOT NULL UNIQUE,
  user_id INT UNSIGNED NOT NULL,
  scope VARCHAR(64) NOT NULL DEFAULT 'read_only_dashboard',
  expires_at DATETIME NOT NULL,
  used_at DATETIME NULL,
  revoked_at DATETIME NULL,
  issued_by VARCHAR(120) NOT NULL,
  issued_ip VARBINARY(16) NULL,
  redeemed_ip VARBINARY(16) NULL,
  redeemed_user_agent VARCHAR(512) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_admin_override_user FOREIGN KEY (user_id) REFERENCES players(id) ON DELETE CASCADE,
  INDEX idx_admin_override_active (user_id, expires_at, used_at, revoked_at),
  INDEX idx_admin_override_expiry (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS admin_override_audit (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  token_id BIGINT UNSIGNED NULL,
  user_id INT UNSIGNED NULL,
  action VARCHAR(64) NOT NULL,
  scope VARCHAR(64) NULL,
  ip_address VARBINARY(16) NULL,
  user_agent VARCHAR(512) NULL,
  metadata JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_admin_override_audit_token FOREIGN KEY (token_id) REFERENCES admin_override_tokens(id) ON DELETE SET NULL,
  CONSTRAINT fk_admin_override_audit_user FOREIGN KEY (user_id) REFERENCES players(id) ON DELETE SET NULL,
  INDEX idx_admin_override_audit_created (created_at),
  INDEX idx_admin_override_audit_user (user_id, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE EVENT IF NOT EXISTS purge_expired_admin_override_tokens
ON SCHEDULE EVERY 1 DAY
DO
  DELETE FROM admin_override_tokens
  WHERE expires_at < (UTC_TIMESTAMP() - INTERVAL 30 DAY)
     OR (revoked_at IS NOT NULL AND revoked_at < (UTC_TIMESTAMP() - INTERVAL 30 DAY));
