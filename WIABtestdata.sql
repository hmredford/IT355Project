

INSERT INTO game (name, publisher, collection, releaseDate, numPlayers, playtime, 
	ageRating, description, imagePath, themes, designer, mechanics, price)
	VALUES('7 Wonders', 'Repos Production','7 Wonders','2010-01-01', 7, 30, '10+', 
	'You are the leader of one of the 7 great cities of the Ancient World. Gather resources, develop commercial routes, and affirm your military supremacy. Build your city and erect an architectural wonder which will transcend future times.

7 Wonders lasts three ages. In each age, players receive seven cards from a particular deck, choose one of those cards, then pass the remainder to an adjacent player. Players reveal their cards simultaneously, paying resources if needed or collecting resources or interacting with other players in various ways. (Players have individual boards with special powers on which to organize their cards, and the boards are double-sided). Each player then chooses another card from the deck they were passed, and the process repeats until players have six cards in play from that age. After three ages, the game ends.

In essence, 7 Wonders is a card development game. Some cards have immediate effects, while others provide bonuses or upgrades later in the game. Some cards provide discounts on future purchases. Some provide military strength to overpower your neighbors and others give nothing but victory points. Each card is played immediately after being drafted, so you\'ll know which cards your neighbor is receiving and how his choices might affect what you\'ve already built up. Cards are passed left-right-left over the three ages, so you need to keep an eye on the neighbors in both directions.

Though the box of earlier editions is listed as being for 3–7 players, there is an official 2-player variant included in the instructions.' 
	,'/images/7wonders.jpg', 'Ancient, City Building, Civilization','Antoien Bauza',
	 'Card Drafting, Hand Management, Set Collection, Variable Player Powers', 35.94),



	('Ticket to Ride', 'Days of Wonder','Ticket to Ride','2004-01-01', 5, 45, '8+', 
	'With elegantly simple gameplay, Ticket to Ride can be learned in under 15 minutes, while providing players with intense strategic and tactical decisions every turn. Players collect cards of various types of train cars they then use to claim railway routes in North America. The longer the routes, the more points they earn. Additional points come to those who fulfill Destination Tickets – goal cards that connect distant cities; and to the player who builds the longest continuous route.

"The rules are simple enough to write on a train ticket – each turn you either draw more cards, claim a route, or get additional Destination Tickets," says Ticket to Ride author, Alan R. Moon. "The tension comes from being forced to balance greed – adding more cards to your hand, and fear – losing a critical route to a competitor."

Ticket to Ride continues in the tradition of Days of Wonder\'s big format board games featuring high-quality illustrations and components including: an oversize board map of North America, 225 custom-molded train cars, 144 illustrated cards, and wooden scoring markers.' 
	,'/images/tickettoride.jpg', 'Trains, Travel','Alan R. Moon', 'Card Drafting, Hand Management, Network Building, Set Collection', 35.94),



	('The Resistance', 'Indie Boards & Cards','Dystopia, Werewolf, Mafia','2009-01-01', 10, 30, '13+', 
	'The Empire must fall. Our mission must succeed. By destroying their key bases, we will shatter Imperial strength and liberate our people. Yet spies have infiltrated our ranks, ready for sabotage. We must unmask them. In five nights we reshape destiny or die trying. We are the Resistance!

The Resistance is a party game of social deduction. It is designed for five to ten players, lasts about 30 minutes, and has no player elimination. The Resistance is inspired by Mafia/Werewolf, yet it is unique in its core mechanics, which increase the resources for informed decisions, intensify player interaction, and eliminate player elimination.

Players are either Resistance Operatives or Imperial Spies. For three to five rounds, they must depend on each other to carry out missions against the Empire. At the same time, they must try to deduce the other players’ identities and gain their trust. Each round begins with discussion. When ready, the Leader entrusts sets of Plans to a certain number of players (possibly including himself/herself). Everyone votes on whether or not to approve the assignment. Once an assignment passes, the chosen players secretly decide to Support or Sabotage the mission. Based on the results, the mission succeeds (Resistance win) or fails (Empire win). When a team wins three missions, they have won the game.' 
	,'/images/resistance.jpg', 'Bluffing, Deduction, Negotiation, Party, Spies','Don Eskridge', 'Hidden Identity, Voting', 13.21),



	('Catan', 'KOSMOS','Catan','1995-01-01', 4, 80, '10+', 
	'Catan (formerly The Settlers of Catan), players try to be the dominant force on the island of Catan by building settlements, cities, and roads. On each turn dice are rolled to determine what resources the island produces. Players collect these resources (cards)—wood, grain, brick, sheep, or stone—to build up their civilizations to get to 10 victory points and win the game.

Setup includes randomly placing large hexagonal tiles (each showing a resource or the desert) in a honeycomb shape and surrounding them with water tiles, some of which contain ports of exchange. Number disks, which will correspond to die rolls (two 6-sided dice are used), are placed on each resource tile. Each player is given two settlements (think: houses) and roads (sticks) which are, in turn, placed on intersections and borders of the resource tiles. Players collect a hand of resource cards based on which hex tiles their last-placed house is adjacent to. A robber pawn is placed on the desert tile.

A turn consists of possibly playing a development card, rolling the dice, everyone (perhaps) collecting resource cards based on the roll and position of houses (or upgraded cities—think: hotels) unless a 7 is rolled, turning in resource cards (if possible and desired) for improvements, trading cards at a port, and trading resource cards with other players. If a 7 is rolled, the active player moves the robber to a new hex tile and steals resource cards from other players who have built structures adjacent to that tile.

Points are accumulated by building settlements and cities, having the longest road and the largest army (from some of the development cards), and gathering certain development cards that simply award victory points. When a player has gathered 10 points (some of which may be held in secret), he announces his total and claims the win.

Catan has won multiple awards and is one of the most popular games in recent history due to its amazing ability to appeal to experienced gamers as well as those new to the hobby.' 
	,'/images/catan.jpg', 'Negotiation, City Building', 'Klaus Teuber', 'Dice Rolling, Hand Management, Modular Board, Network Building, Trading', 35.18)




INSERT INTO customer(username, password, firstName,lastName,
email, address, city, state, zip)
VALUES('steve1',SHA2('steveisboss',256),'Steve','Stevenson','steve1@mail.com',
'967 W South Street','Springville','UT', 84632),

('megan2',SHA2('meganischill',256),'Megan','Meggson','megan2@mail.com',
'910 S East Street','Orem','UT', 84702),

('Hayden3',SHA2('haydenneedssleep',256),'Hayden','Redford','hayden3@mail.com',
'409 W Some Street','Provo','UT', 84602);



INSERT INTO review(rating ,reviewDate,comment,customerID,productID)
VALUES (5.0, CURRENT_TIMESTAMP, 'Highly reccommend', 
	(SELECT customerID from customer WHERE username="megan2"),
	(SELECT productID FROM game WHERE name="Ticket to Ride")),
	(4.0, CURRENT_TIMESTAMP, 'Fun and instruccional.', 
	(SELECT customerID from customer WHERE username="steve1"),
	(SELECT productID FROM game WHERE name="7 Wonders")),
	(4.0, CURRENT_TIMESTAMP, 'It is a good game, but takes a really long time to play.', 
	(SELECT customerID from customer WHERE username="hayden3"),
	(SELECT productID FROM game WHERE name="Catan"))
	;
	


INSERT INTO custOrder(orderDate,paymentMethod,paymentTotal,paymentDate,customerID)
VALUES(CURRENT_TIMESTAMP, 'PayPal', '0.00', CURRENT_TIMESTAMP, 
	(SELECT customerID FROM customer WHERE username="steve1")),
(CURRENT_TIMESTAMP, 'PayPal', '0.00', CURRENT_TIMESTAMP, 
	(SELECT customerID FROM customer WHERE username="megan2")),
(CURRENT_TIMESTAMP, 'PayPal', '0.00', CURRENT_TIMESTAMP, 
	(SELECT customerID FROM customer WHERE username="hayden3"));



INSERT INTO custOrderList(custOrder,productID, quantity)
VALUES((SELECT custOrder FROM custOrder WHERE customerID = (SELECT customerID from customer WHERE username='steve1')),
	 (SELECT productID FROM game WHERE name="7 Wonders"), 1),
	((SELECT custOrder FROM custOrder WHERE customerID = (SELECT customerID from customer WHERE username='megan2')),
	 (SELECT productID FROM game WHERE name="The Resistance"), 1),
	((SELECT custOrder FROM custOrder WHERE customerID = (SELECT customerID from customer WHERE username='megan2')),
	 (SELECT productID FROM game WHERE name="Catan"), 1),

	((SELECT custOrder FROM custOrder WHERE customerID = (SELECT customerID from customer WHERE username='hayden3')),
	 (SELECT productID FROM game WHERE name="Ticket to Ride"), 1)
	;


INSERT INTO supplier(name,phone)
VALUES('Amazon', 18015551234),
('Boardgame Co', 18015559876);

INSERT INTO warehouse(name,	address,city,state,	zip)
VALUES('Orem UT', '910 N Southstreet', 'Orem', 'UT', 84702),
('Twin Falls ID', '693 S Weststreet', 'Twin Falls', 'ID', 70549);


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
	VALUES(CURRENT_TIMESTAMP, 'WIAB ACCOUNT', 200.00, CURRENT_TIMESTAMP, 1,1),
	(CURRENT_TIMESTAMP, 'WIAB ACCOUNT', 100.00, CURRENT_TIMESTAMP, 2,2);


INSERT INTO merchOrderList(merchOrder,productID, quantity)
VALUES
((SELECT merchOrder FROM merchOrder WHERE employeeID=1 LIMIT 1),
	 (SELECT productID FROM game WHERE name="7 Wonders"), 5),

((SELECT merchOrder FROM merchOrder WHERE employeeID=2 LIMIT 1),
	 (SELECT productID FROM game WHERE name="The Resistance"), 4)
;


INSERT INTO shipping(custOrder,warehouseID,	carrierID,status)
VALUES((SELECT custOrder FROM custOrder WHERE customerID=(SELECT customerID FROM customer WHERE username='steve1')),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),1,'pending'),
	
	((SELECT custOrder FROM custOrder WHERE customerID=(SELECT customerID FROM customer WHERE username='megan2')),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),2,'pending'),

	((SELECT custOrder FROM custOrder WHERE customerID=(SELECT customerID FROM customer WHERE username='hayden3')),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),2,'pending')
	;


INSERT INTO receiving (merchOrder,warehouseID,carrierID,status)
VALUES((SELECT merchOrder FROM merchOrder WHERE employeeID=1 LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),1,'pending'),
((SELECT merchOrder FROM merchOrder WHERE employeeID=2),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),1,'pending')
	;


INSERT INTO inventory(productID,warehouseID,quantity)
VALUES((SELECT productID FROM game WHERE name='The Resistance' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Twin Falls ID'),5),
((SELECT productID FROM game WHERE name='7 Wonders' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Twin Falls ID'),2),
((SELECT productID FROM game WHERE name='Ticket to Ride' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Twin Falls ID'),3),
((SELECT productID FROM game WHERE name='Catan' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Twin Falls ID'),5),

((SELECT productID FROM game WHERE name='The Resistance' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),4),
((SELECT productID FROM game WHERE name='7 Wonders' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),3),
((SELECT productID FROM game WHERE name='Ticket to Ride' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),5),
((SELECT productID FROM game WHERE name='Catan' LIMIT 1),
	(SELECT WarehouseID FROM warehouse WHERE name='Orem UT'),6)
;


INSERT INTO users(username, password, admin)
VALUES('admin',SHA2('bannanatoast',256), 1);