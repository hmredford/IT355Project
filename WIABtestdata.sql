INSERT INTO game(name, publisher, collection, releaseDate, numPlayers, 
	playtime, ageRating, description, imagePath, themes, designer, mechanics)
	VALUES('testgame', 'me','mine','2017-04-02', 4, 20, '0+', 
	'This is a test game. It has no rules. It isnt any fun. But it is here and it is useful. Thanks for looking at testgame.' 
	,'/images/testgame.jpg', 'testing','me', 'none');


INSERT INTO customer(username, password, firstName,lastName,
email, address, city, state, zip)
VALUES('testuser','','Tessy','Tester','tester@test.com',
'967 E Testwest','Testerville','TS', 12345);


INSERT INTO review(rating ,reviewDate,comment,customerID,productID)
VALUES ('3.0', CURRENT_TIMESTAMP, 'This game is barely testable.', 
	(SELECT customerID from customer WHERE username="testuser"),
	(SELECT productID FROM game WHERE name="testgame"));
	

INSERT INTO custOrder(orderDate,paymentMethod,paymentTotal,paymentDate,customerID)
VALUES(CURRENT_TIMESTAMP, 'VISA', '0.00', CURRENT_TIMESTAMP, 
	(SELECT customerID FROM customer WHERE username="testuser"));

INSERT INTO custOrderList(custOrder,productID, quantity)
VALUES(1,(SELECT productID FROM game WHERE name="testgame"), 2);


INSERT INTO supplier(name,phone)
VALUES('testsupplier', 18015551234);

INSERT INTO warehouse(name,	address,city,state,	zip)
VALUES('testwarehouse', '910 N Southstreet', 'testervillle', 'TS', 12345);


INSERT INTO employee(firstName,	lastName,hireDate,phone,email,address,city,
	state,zip,warehouseID,position)
	VALUES('Todd', 'Tester', CURRENT_DATE, 18015554321, 'ttester@wiab.com', '1911 E Weststreet',
	'Testerville', 'TS', 12345, 1, 'testmanager');


INSERT INTO carrier(name, phone)
VALUES ('testEX', 18015550001);

INSERT INTO merchOrder(
	orderDate,paymentMethod,paymentTotal,Payment_Date,employeeID)
	VALUES(CURRENT_TIMESTAMP, 'TEST ACCOUNT', '0.00', CURRENT_TIMESTAMP, 1);

INSERT INTO merchOrderList(merchOrder,productID, quantity)
VALUES(1,1,2);

INSERT INTO shipping(custOrder,warehouseID,	carrierID,status)
VALUES(1,1,1,'Pending');


INSERT INTO receiving (merchOrder,warehouseID,carrierID,status)
VALUES(1,1,1,"Pending");

INSERT INTO inventory(productID,warehouseID,quantity)
VALUES(1,1,5);