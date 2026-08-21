-- Extend rankings with technology, glory, and penalty components used by the server ranking contract.
ALTER TABLE rankings ADD COLUMN IF NOT EXISTS technology_score BIGINT NOT NULL DEFAULT 0 AFTER covert_score;
ALTER TABLE rankings ADD COLUMN IF NOT EXISTS glory_score BIGINT NOT NULL DEFAULT 0 AFTER technology_score;
ALTER TABLE rankings ADD COLUMN IF NOT EXISTS penalty_score BIGINT NOT NULL DEFAULT 0 AFTER glory_score;

ALTER TABLE rank_snapshots ADD COLUMN IF NOT EXISTS technology_score BIGINT NOT NULL DEFAULT 0 AFTER covert_score;
ALTER TABLE rank_snapshots ADD COLUMN IF NOT EXISTS glory_score BIGINT NOT NULL DEFAULT 0 AFTER technology_score;
ALTER TABLE rank_snapshots ADD COLUMN IF NOT EXISTS penalty_score BIGINT NOT NULL DEFAULT 0 AFTER glory_score;

INSERT INTO glory_reputation(player_id,glory,reputation)
SELECT p.id,0,0 FROM players p
LEFT JOIN glory_reputation gr ON gr.player_id=p.id
WHERE gr.player_id IS NULL;
