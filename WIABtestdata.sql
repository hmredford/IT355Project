INSERT INTO game(name, publisher, collection, releaseDate, numPlayers, 
	playtime, ageRating, description, imagePath, themes, designer, mechanics, price)
	VALUES('Test Game', 'me','mine','2017-04-02', 4, 20, '0+', 
	'This is a test game. It has no rules. It isnt any fun. But it is here and it is useful. Thanks for looking at testgame.' 
	,'/images/testgame.jpg', 'testing','me', 'none', 10.00),
	('Test Game 2', 'me','mine','2016-04-02', 7, 10, '5+', 
	'This is a another test game. It has no rules. It also isnt any fun. But it is here and it is useful. Thanks for looking at Test Game2.' 
	,'/images/testgame2.jpg', 'testing','me', 'none', 12.00);


INSERT INTO customer(username, password, firstName,lastName,
email, address, city, state, zip)
VALUES('ttest','','Tessy','Tester','tester@test.com',
'967 E Testwest','Testerville','TS', 12345),
('tomtest','','Tommy','Tester','tommytester@test.com',
'967 E Testwest','Testerville','TS', 12345);


INSERT INTO review(rating ,reviewDate,comment,customerID,productID)
VALUES (3.0, CURRENT_TIMESTAMP, 'This game is barely testable.', 
	(SELECT customerID from customer WHERE username="ttest"),
	(SELECT productID FROM game WHERE name="Test Game")),
	(4.0, CURRENT_TIMESTAMP, 'This game is testable.', 
	(SELECT customerID from customer WHERE username="tomtest"),
	(SELECT productID FROM game WHERE name="Test Game 2"));
	

INSERT INTO custOrder(orderDate,paymentMethod,paymentTotal,paymentDate,customerID)
VALUES(CURRENT_TIMESTAMP, 'PayPal', '12.00', CURRENT_TIMESTAMP, 
	(SELECT customerID FROM customer WHERE username="ttest")),
(CURRENT_TIMESTAMP, 'PayPal', '10.00', CURRENT_TIMESTAMP, 
	(SELECT customerID FROM customer WHERE username="tomtest"));

INSERT INTO custOrderList(custOrder,productID, quantity)
VALUES(1,1, 2),
	(2,2, 2);


INSERT INTO supplier(name,phone)
VALUES('Game Supply', 18015551234),
('Boardgame Co', 18015559876);

INSERT INTO warehouse(name,	address,city,state,	zip)
VALUES('Warehouse 1', '910 N Southstreet', 'Testervillle', 'TS', 12345),
('Warehouse 2', '693 S Weststreet', 'Circleville', 'MS', 95832);


INSERT INTO employee(firstName,	lastName,hireDate,phone,email,address,city,
	state,zip,warehouseID,position)
	VALUES('Todd', 'Tester', CURRENT_DATE, 18015554321, 'ttester@wiab.com', '1911 E Weststreet',
	'Testerville', 'TS', 12345, 1, 'Manager'),
	('Sally', 'Sullvester', CURRENT_DATE, 18015558593, 'ssullvester@wiab.com', '8053 E Northstreet',
	'Testerville', 'TS', 12345, 1, 'Merchandizer'),
	('Ron', 'Ronald', CURRENT_DATE, 18015551346, 'rronlad@wiab.com', '867 W Creekstreet',
	'Circleville', 'MS', 69492, 2, 'Manager');


INSERT INTO carrier(name, phone)
VALUES ('FedEX', 18015550001),
('UPS', 18015550002);

INSERT INTO merchOrder(
	orderDate,paymentMethod,paymentTotal,PaymentDate,employeeID, supplierID)
	VALUES(CURRENT_TIMESTAMP, 'TEST ACCOUNT', 40.00, CURRENT_TIMESTAMP, 1,1),
	(CURRENT_TIMESTAMP, 'TEST ACCOUNT', 78.00, CURRENT_TIMESTAMP, 2,2);

INSERT INTO merchOrderList(merchOrder,productID, quantity)
VALUES(1,1,2),
(2,2,3);

INSERT INTO shipping(custOrder,warehouseID,	carrierID,status)
VALUES(1,1,1,'pending'),
(2,2,2,'pending');


INSERT INTO receiving (merchOrder,warehouseID,carrierID,status)
VALUES(1,1,1,"pending"),
(2,2,2,"pending");

INSERT INTO inventory(productID,warehouseID,quantity)
VALUES(1,1,5),
(1,2,5),
(2,1,7),
(2,2,3);

INSERT INTO users(username, password)
VALUES('admin',SHA2('bannanatoast',256));