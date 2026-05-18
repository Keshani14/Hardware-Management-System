-- Restores missing material_category rows required by materials.php.
-- Safe to run more than once: existing category IDs are updated with current totals.

USE umms;

INSERT INTO material_category (category_id, category_name, quantity_all, unit, extension)
VALUES
    (1, 'Cement', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 1), '(50KG)', 'jpg'),
    (2, 'Sand', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 2), 'cube', 'jpeg'),
    (3, 'Bricks', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 3), 'bricks', 'png'),
    (4, 'Binding Wires', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 4), 'KG', 'jpg'),
    (5, 'Paving Tiles', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 5), 'Pcs', 'jpg'),
    (6, 'Floor Tiles', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 6), 'Pcs', 'png'),
    (7, 'Bulbs', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 7), 'Pcs', 'jpg'),
    (8, 'Roofing Sheets', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 8), 'Pcs', 'jpg'),
    (9, 'GI Pipes', (SELECT COALESCE(SUM(quantity), 0) FROM materials WHERE category_id = 9), 'Pcs', 'jpg')
ON DUPLICATE KEY UPDATE
    category_name = VALUES(category_name),
    quantity_all = VALUES(quantity_all),
    unit = VALUES(unit),
    extension = VALUES(extension);
