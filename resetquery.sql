UPDATE acts set balance = 0;
UPDATE customers set balance = 0;
UPDATE vendors set balance = 0;


UPDATE items set price = 0 , quantity = 0, sellprice = 0, stock = 0;



DELETE  FROM transaction;
DELETE  FROM itemslog;

TRUNCATE TABLE journal;



