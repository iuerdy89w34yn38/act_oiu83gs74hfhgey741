UPDATE acts set balance = 0;
UPDATE customers set balance = 0;
UPDATE vendors set balance = 0;
DELETE  FROM journal;
DELETE  FROM itemslog;

TRUNCATE TABLE ledger;
TRUNCATE TABLE items;

DELETE FROM itemsb WHERE id>1;

