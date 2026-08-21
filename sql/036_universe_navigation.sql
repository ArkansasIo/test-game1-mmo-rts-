USE stargatewars;

-- Universe Civilization: Empire at Wars migration 036: complete Universe navigation.
INSERT INTO menu_items (parent_id, label, route, icon, sort_order)
VALUES (NULL, 'Universe', 'universe', '✦', 12)
ON DUPLICATE KEY UPDATE label = VALUES(label), icon = VALUES(icon), sort_order = VALUES(sort_order);

INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Galaxy Map', 'galaxies', 1 FROM menu_items WHERE route = 'universe'
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order);
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Sector Map', 'sectors', 2 FROM menu_items WHERE route = 'universe'
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order);
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Solar Systems', 'solar-systems', 3 FROM menu_items WHERE route = 'universe'
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order);
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Universe Planets', 'universe-planets', 4 FROM menu_items WHERE route = 'universe'
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order);
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Moon Registry', 'moons', 5 FROM menu_items WHERE route = 'universe'
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order);
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Coordinate Search', 'coordinates', 6 FROM menu_items WHERE route = 'universe'
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order);

INSERT INTO page_content (route, title, description, minimum_rank_level) VALUES
('galaxies', 'Galaxy Map', 'Inspect discovered galaxies and sectors.', 1),
('sectors', 'Sector Map', 'Scan sectors and travel lanes.', 1),
('solar-systems', 'Solar Systems', 'Inspect system orbit maps and gate access.', 1),
('universe-planets', 'Universe Planets', 'Inspect planets and colonization status.', 1),
('moons', 'Moon Registry', 'Inspect moons and jump-gate infrastructure.', 1),
('coordinates', 'Coordinate Search', 'Search validated universe coordinates.', 1)
ON DUPLICATE KEY UPDATE title = VALUES(title), description = VALUES(description), minimum_rank_level = VALUES(minimum_rank_level);
