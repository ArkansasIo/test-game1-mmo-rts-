USE stargatewars;

INSERT INTO players (username,display_name,password_hash,race_id,rank_level,rank_name)
SELECT 'opponent_demo','Rival Commander',SHA2('demo123',256),id,2,'Officer' FROM races WHERE name='Asgard'
AND NOT EXISTS (SELECT 1 FROM players WHERE username='opponent_demo');
INSERT INTO player_resources (player_id,naquadah,banked_naquadah,attack_turns,untrained_units,unit_production,miners,lifers,attack_units,defense_units,spies,anti_spies)
SELECT id,250000,350000,48,1400,10,100,10,1100,900,120,180 FROM players WHERE username='opponent_demo'
AND NOT EXISTS (SELECT 1 FROM player_resources r WHERE r.player_id=players.id);
INSERT INTO player_unit_stats (player_id) SELECT id FROM players WHERE username='opponent_demo'
AND NOT EXISTS (SELECT 1 FROM player_unit_stats s WHERE s.player_id=players.id);
INSERT INTO motherships (player_id,name) SELECT id,'Rival Command Vessel' FROM players WHERE username='opponent_demo'
AND NOT EXISTS (SELECT 1 FROM motherships m WHERE m.player_id=players.id);
INSERT INTO protection_states (player_id) SELECT id FROM players WHERE username='opponent_demo'
AND NOT EXISTS (SELECT 1 FROM protection_states s WHERE s.player_id=players.id);
INSERT INTO rankings (player_id) SELECT id FROM players WHERE username='opponent_demo'
AND NOT EXISTS (SELECT 1 FROM rankings r WHERE r.player_id=players.id);
INSERT INTO target_realms (name,race_name,rank_position,attack_score,defense_score,covert_score)
SELECT 'Rival Commander','Asgard',12,1100,900,500
WHERE NOT EXISTS (SELECT 1 FROM target_realms WHERE name='Rival Commander');
