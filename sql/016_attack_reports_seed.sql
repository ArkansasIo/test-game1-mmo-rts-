-- Attack Log & Reports support.
ALTER TABLE intelligence_reports ADD COLUMN IF NOT EXISTS seen_at DATETIME NULL AFTER payload;

-- Seed a small demo report feed only when no battle report exists for the demo commander.
INSERT INTO battles (attacker_id, defender_id, action_type, turns_spent, attacker_score, defender_score, winner_id, loot, attacker_casualties, defender_casualties)
SELECT p.id, d.id, 'attack', 1, 4800, 2200, p.id, 84000, 0, 12
FROM players p JOIN players d ON d.id <> p.id
WHERE p.username='demo' AND NOT EXISTS (SELECT 1 FROM battle_reports br WHERE br.recipient_id=p.id)
LIMIT 1;

INSERT INTO battle_reports (battle_id, recipient_id, report_text, report_json)
SELECT b.id,b.attacker_id,'Victory — loot: 84000',JSON_OBJECT('result','Victory','loot',84000,'turns',1)
FROM battles b JOIN players p ON p.id=b.attacker_id
WHERE p.username='demo' AND b.loot=84000 AND NOT EXISTS (SELECT 1 FROM battle_reports br WHERE br.battle_id=b.id AND br.recipient_id=b.attacker_id)
LIMIT 1;
