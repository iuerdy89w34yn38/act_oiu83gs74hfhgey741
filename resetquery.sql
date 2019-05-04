UPDATE acts set balance = 0;
UPDATE customers set balance = 0;
UPDATE vendors set balance = 0;
DELETE  FROM transaction;
DELETE  FROM itemslog;

TRUNCATE TABLE journal;
TRUNCATE TABLE items;

DELETE FROM itemsb WHERE id>1;

