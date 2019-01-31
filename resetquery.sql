UPDATE acts set balance = 0;
TRUNCATE TABLE itemslog;
TRUNCATE TABLE ledger;
TRUNCATE TABLE journal;
DELETE * FROM customers;
DELETE * FROM vendors;
TRUNCATE TABLE items;
DELETE * FROM itemsb WHERE id=0;

