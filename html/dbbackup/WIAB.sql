-- MySQL dump 10.13  Distrib 5.5.59, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: WIAB
-- ------------------------------------------------------
-- Server version	5.5.59-0ubuntu0.14.04.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrier` (
  `carrierID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`carrierID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrier`
--

LOCK TABLES `carrier` WRITE;
/*!40000 ALTER TABLE `carrier` DISABLE KEYS */;
INSERT INTO `carrier` VALUES (1,'FedEX','18015550001'),(2,'UPS','18015550002');
/*!40000 ALTER TABLE `carrier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custOrder`
--

DROP TABLE IF EXISTS `custOrder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custOrder` (
  `custOrder` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paymentMethod` varchar(255) NOT NULL,
  `paymentTotal` float(16,2) NOT NULL,
  `paymentDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `customerID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`custOrder`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `custOrder_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custOrder`
--

LOCK TABLES `custOrder` WRITE;
/*!40000 ALTER TABLE `custOrder` DISABLE KEYS */;
INSERT INTO `custOrder` VALUES (1,'2018-03-24 20:59:16','PayPal',0.00,'2018-03-24 20:59:16',1),(2,'2018-03-24 20:59:16','PayPal',0.00,'2018-03-24 20:59:16',2),(3,'2018-03-24 20:59:16','PayPal',0.00,'2018-03-24 20:59:16',3),(4,'2018-03-29 17:36:42','PayPal',49.00,'2018-03-29 17:36:42',2),(5,'2018-03-29 17:40:45','PayPal',36.00,'2018-03-29 17:40:45',2),(6,'2018-03-30 00:49:59','PayPal',61.00,'2018-03-30 00:49:59',2),(7,'2018-03-30 00:54:45','PayPal',49.00,'2018-03-30 00:54:45',2),(8,'2018-03-30 00:57:14','PayPal',71.00,'2018-03-30 00:57:14',2),(9,'2018-03-30 01:01:01','PayPal',36.00,'2018-03-30 01:01:01',2),(10,'2018-03-30 01:02:06','PayPal',36.00,'2018-03-30 01:02:06',2),(11,'2018-03-30 01:08:12','PayPal',36.00,'2018-03-30 01:08:12',2),(12,'2018-03-30 01:09:58','PayPal',36.00,'2018-03-30 01:09:58',2),(13,'2018-03-30 01:10:48','PayPal',36.00,'2018-03-30 01:10:48',2),(14,'2018-03-30 01:11:58','PayPal',36.00,'2018-03-30 01:11:58',2),(15,'2018-03-30 01:16:20','PayPal',360.00,'2018-03-30 01:16:20',2),(16,'2018-03-30 01:17:38','PayPal',710.00,'2018-03-30 01:17:38',2),(17,'2018-03-30 01:28:28','PayPal',35.00,'2018-03-30 01:28:28',2),(18,'2018-03-30 01:29:23','PayPal',35.00,'2018-03-30 01:29:23',2),(19,'2018-03-30 01:30:31','PayPal',130.00,'2018-03-30 01:30:31',2),(20,'2018-03-30 01:32:21','PayPal',350.00,'2018-03-30 01:32:21',2),(21,'2018-03-30 01:34:20','PayPal',36.00,'2018-03-30 01:34:20',2),(26,'2018-03-30 08:39:05','PayPal',3500.00,'2018-03-30 08:39:05',2),(27,'2018-03-30 08:40:52','PayPal',7200.00,'2018-03-30 08:40:52',2),(28,'2018-03-30 08:49:24','PayPal',143.00,'2018-03-30 08:49:24',2),(29,'2018-03-30 08:51:23','PayPal',156.00,'2018-03-30 08:51:23',2),(30,'2018-03-30 08:51:39','PayPal',156.00,'2018-03-30 08:51:39',2),(31,'2018-03-30 08:52:35','PayPal',247.00,'2018-03-30 08:52:35',2),(32,'2018-03-30 08:56:47','PayPal',72.00,'2018-03-30 08:56:47',2);
/*!40000 ALTER TABLE `custOrder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custOrderList`
--

DROP TABLE IF EXISTS `custOrderList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custOrderList` (
  `custOrder` int(10) unsigned NOT NULL,
  `productID` int(10) unsigned NOT NULL,
  `quantity` int(2) unsigned NOT NULL DEFAULT '1',
  KEY `custOrder` (`custOrder`),
  CONSTRAINT `custOrderList_ibfk_1` FOREIGN KEY (`custOrder`) REFERENCES `custOrder` (`custOrder`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custOrderList`
--

LOCK TABLES `custOrderList` WRITE;
/*!40000 ALTER TABLE `custOrderList` DISABLE KEYS */;
INSERT INTO `custOrderList` VALUES (1,1,1),(2,3,1),(2,4,1),(3,2,1),(15,2,2),(16,2,2),(16,4,4),(17,4,1),(18,4,1),(19,3,10),(20,4,10),(21,1,1),(26,4,100),(27,1,200),(29,3,12),(30,3,12),(31,3,19),(32,1,2);
/*!40000 ALTER TABLE `custOrderList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `custOrderSummary`
--

DROP TABLE IF EXISTS `custOrderSummary`;
/*!50001 DROP VIEW IF EXISTS `custOrderSummary`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `custOrderSummary` (
  `custOrder` tinyint NOT NULL,
  `customerID` tinyint NOT NULL,
  `firstName` tinyint NOT NULL,
  `lastName` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `quantity` tinyint NOT NULL,
  `orderDate` tinyint NOT NULL,
  `paymentMethod` tinyint NOT NULL,
  `paymentTotal` tinyint NOT NULL,
  `paymentDate` tinyint NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstName` varchar(16) NOT NULL,
  `lastName` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` int(9) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'steve1','a4322454e1ddb6e3c8f8060ee2904313669a65b9f0c5802b18207ebc09e9f64a','Steve','Stevenson','steve1@mail.com','967 W South Street','Springville','UT',84632),(2,'megan2','37462b3ef522a4b52b225cdc267b0f82569092f8a49831b4bd6eab24a55dc120','Megan','Meggson','megan2@mail.com','910 S East Street','Orem','UT',84702),(3,'Hayden3','eb0cd6f5459f60a7a0e090d3211fa84cfb9ae3fe97cfefc9d052772b69b14727','Hayden','Redford','hayden3@mail.com','409 W Some Street','Provo','UT',84602),(4,'Danny4','dannyboy','Danis','Daniels','danny4@mail.com','495 E 305 N','Payson','UT',86924);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `employeeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `hireDate` date NOT NULL,
  `phone` int(10) unsigned DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` int(9) NOT NULL,
  `warehouseID` int(10) unsigned DEFAULT NULL,
  `position` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`employeeID`),
  KEY `warehouseID` (`warehouseID`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Todd','Tester','2018-03-24',4294967295,'ttester@wiab.com','1911 E Weststreet','Testerville','TS',12345,1,'Manager'),(2,'Sally','Sullvester','2018-03-24',4294967295,'ssullvester@wiab.com','8053 E Northstreet','Testerville','TS',12345,1,'Merchandizer'),(3,'Ron','Ronald','2018-03-24',4294967295,'rronlad@wiab.com','867 W Creekstreet','Circleville','MS',69492,2,'Manager');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `productID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `publisher` varchar(128) NOT NULL DEFAULT '',
  `collection` varchar(128) DEFAULT '',
  `releaseDate` date DEFAULT NULL,
  `numPlayers` int(2) unsigned NOT NULL DEFAULT '2',
  `playtime` int(3) unsigned DEFAULT '30',
  `ageRating` varchar(64) NOT NULL DEFAULT '8+',
  `description` mediumtext NOT NULL,
  `imagePath` varchar(128) NOT NULL DEFAULT '',
  `themes` varchar(128) NOT NULL DEFAULT '',
  `designer` varchar(128) NOT NULL DEFAULT '',
  `mechanics` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(10,0) NOT NULL DEFAULT '5',
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'7 Wonders','Repos Production','7 Wonders','2010-01-01',7,30,'10+','You are the leader of one of the 7 great cities of the Ancient World. Gather resources, develop commercial routes, and affirm your military supremacy. Build your city and erect an architectural wonder which will transcend future times.\n\n7 Wonders lasts three ages. In each age, players receive seven cards from a particular deck, choose one of those cards, then pass the remainder to an adjacent player. Players reveal their cards simultaneously, paying resources if needed or collecting resources or interacting with other players in various ways. (Players have individual boards with special powers on which to organize their cards, and the boards are double-sided). Each player then chooses another card from the deck they were passed, and the process repeats until players have six cards in play from that age. After three ages, the game ends.\n\nIn essence, 7 Wonders is a card development game. Some cards have immediate effects, while others provide bonuses or upgrades later in the game. Some cards provide discounts on future purchases. Some provide military strength to overpower your neighbors and others give nothing but victory points. Each card is played immediately after being drafted, so you\'ll know which cards your neighbor is receiving and how his choices might affect what you\'ve already built up. Cards are passed left-right-left over the three ages, so you need to keep an eye on the neighbors in both directions.\n\nThough the box of earlier editions is listed as being for 3–7 players, there is an official 2-player variant included in the instructions.','/images/7wonders.jpg','Ancient, City Building, Civilization','Antoien Bauza','Card Drafting, Hand Management, Set Collection, Variable Player Powers',36),(2,'Ticket to Ride','Days of Wonder','Ticket to Ride','2004-01-01',5,45,'8+','With elegantly simple gameplay, Ticket to Ride can be learned in under 15 minutes, while providing players with intense strategic and tactical decisions every turn. Players collect cards of various types of train cars they then use to claim railway routes in North America. The longer the routes, the more points they earn. Additional points come to those who fulfill Destination Tickets – goal cards that connect distant cities; and to the player who builds the longest continuous route.\n\n\"The rules are simple enough to write on a train ticket – each turn you either draw more cards, claim a route, or get additional Destination Tickets,\" says Ticket to Ride author, Alan R. Moon. \"The tension comes from being forced to balance greed – adding more cards to your hand, and fear – losing a critical route to a competitor.\"\n\nTicket to Ride continues in the tradition of Days of Wonder\'s big format board games featuring high-quality illustrations and components including: an oversize board map of North America, 225 custom-molded train cars, 144 illustrated cards, and wooden scoring markers.','/images/tickettoride.jpg','Trains, Travel','Alan R. Moon','Card Drafting, Hand Management, Network Building, Set Collection',36),(3,'The Resistance','Indie Boards & Cards','Dystopia, Werewolf, Mafia','2009-01-01',10,30,'13+','The Empire must fall. Our mission must succeed. By destroying their key bases, we will shatter Imperial strength and liberate our people. Yet spies have infiltrated our ranks, ready for sabotage. We must unmask them. In five nights we reshape destiny or die trying. We are the Resistance!\n\nThe Resistance is a party game of social deduction. It is designed for five to ten players, lasts about 30 minutes, and has no player elimination. The Resistance is inspired by Mafia/Werewolf, yet it is unique in its core mechanics, which increase the resources for informed decisions, intensify player interaction, and eliminate player elimination.\n\nPlayers are either Resistance Operatives or Imperial Spies. For three to five rounds, they must depend on each other to carry out missions against the Empire. At the same time, they must try to deduce the other players’ identities and gain their trust. Each round begins with discussion. When ready, the Leader entrusts sets of Plans to a certain number of players (possibly including himself/herself). Everyone votes on whether or not to approve the assignment. Once an assignment passes, the chosen players secretly decide to Support or Sabotage the mission. Based on the results, the mission succeeds (Resistance win) or fails (Empire win). When a team wins three missions, they have won the game.','/images/resistance.jpg','Bluffing, Deduction, Negotiation, Party, Spies','Don Eskridge','Hidden Identity, Voting',13),(4,'Catan','KOSMOS','Catan','1995-01-01',4,80,'10+','Catan (formerly The Settlers of Catan), players try to be the dominant force on the island of Catan by building settlements, cities, and roads. On each turn dice are rolled to determine what resources the island produces. Players collect these resources (cards)—wood, grain, brick, sheep, or stone—to build up their civilizations to get to 10 victory points and win the game.\n\nSetup includes randomly placing large hexagonal tiles (each showing a resource or the desert) in a honeycomb shape and surrounding them with water tiles, some of which contain ports of exchange. Number disks, which will correspond to die rolls (two 6-sided dice are used), are placed on each resource tile. Each player is given two settlements (think: houses) and roads (sticks) which are, in turn, placed on intersections and borders of the resource tiles. Players collect a hand of resource cards based on which hex tiles their last-placed house is adjacent to. A robber pawn is placed on the desert tile.\n\nA turn consists of possibly playing a development card, rolling the dice, everyone (perhaps) collecting resource cards based on the roll and position of houses (or upgraded cities—think: hotels) unless a 7 is rolled, turning in resource cards (if possible and desired) for improvements, trading cards at a port, and trading resource cards with other players. If a 7 is rolled, the active player moves the robber to a new hex tile and steals resource cards from other players who have built structures adjacent to that tile.\n\nPoints are accumulated by building settlements and cities, having the longest road and the largest army (from some of the development cards), and gathering certain development cards that simply award victory points. When a player has gathered 10 points (some of which may be held in secret), he announces his total and claims the win.\n\nCatan has won multiple awards and is one of the most popular games in recent history due to its amazing ability to appeal to experienced gamers as well as those new to the hobby.','/images/catan.jpg','Negotiation, City Building','Klaus Teuber','Dice Rolling, Hand Management, Modular Board, Network Building, Trading',35);
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `productID` int(10) unsigned NOT NULL,
  `warehouseID` int(10) unsigned NOT NULL,
  `quantity` int(2) unsigned NOT NULL DEFAULT '1',
  KEY `productID` (`productID`),
  KEY `warehouseID` (`warehouseID`),
  CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `game` (`productID`),
  CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (3,2,5),(1,2,2),(2,2,3),(4,2,5),(3,1,4),(1,1,3),(2,1,5),(4,1,6);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchOrder`
--

DROP TABLE IF EXISTS `merchOrder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchOrder` (
  `merchOrder` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paymentMethod` varchar(255) NOT NULL,
  `paymentTotal` decimal(10,0) NOT NULL,
  `PaymentDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `employeeID` int(10) unsigned NOT NULL,
  `supplierID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`merchOrder`),
  KEY `employeeID` (`employeeID`),
  KEY `supplierID` (`supplierID`),
  CONSTRAINT `merchOrder_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`),
  CONSTRAINT `merchOrder_ibfk_2` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchOrder`
--

LOCK TABLES `merchOrder` WRITE;
/*!40000 ALTER TABLE `merchOrder` DISABLE KEYS */;
INSERT INTO `merchOrder` VALUES (1,'2018-03-24 21:04:04','WIAB ACCOUNT',200,'2018-03-24 21:04:04',1,1),(2,'2018-03-24 21:04:04','WIAB ACCOUNT',100,'2018-03-24 21:04:04',2,2);
/*!40000 ALTER TABLE `merchOrder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchOrderList`
--

DROP TABLE IF EXISTS `merchOrderList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchOrderList` (
  `merchOrder` int(10) unsigned NOT NULL,
  `productID` int(10) unsigned NOT NULL,
  `quantity` int(2) unsigned NOT NULL DEFAULT '1',
  KEY `merchOrder` (`merchOrder`),
  KEY `productID` (`productID`),
  CONSTRAINT `merchOrderList_ibfk_1` FOREIGN KEY (`merchOrder`) REFERENCES `merchOrder` (`merchOrder`),
  CONSTRAINT `merchOrderList_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `game` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchOrderList`
--

LOCK TABLES `merchOrderList` WRITE;
/*!40000 ALTER TABLE `merchOrderList` DISABLE KEYS */;
INSERT INTO `merchOrderList` VALUES (1,1,5),(2,3,4);
/*!40000 ALTER TABLE `merchOrderList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiving`
--

DROP TABLE IF EXISTS `receiving`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiving` (
  `merchOrder` int(10) unsigned NOT NULL,
  `warehouseID` int(10) unsigned NOT NULL,
  `carrierID` int(10) unsigned DEFAULT NULL,
  `status` varchar(128) NOT NULL DEFAULT 'Pending',
  KEY `merchOrder` (`merchOrder`),
  KEY `warehouseID` (`warehouseID`),
  KEY `carrierID` (`carrierID`),
  CONSTRAINT `receiving_ibfk_1` FOREIGN KEY (`merchOrder`) REFERENCES `merchOrder` (`merchOrder`),
  CONSTRAINT `receiving_ibfk_2` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`),
  CONSTRAINT `receiving_ibfk_3` FOREIGN KEY (`carrierID`) REFERENCES `carrier` (`carrierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiving`
--

LOCK TABLES `receiving` WRITE;
/*!40000 ALTER TABLE `receiving` DISABLE KEYS */;
INSERT INTO `receiving` VALUES (1,1,1,'pending'),(2,1,1,'pending');
/*!40000 ALTER TABLE `receiving` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `reviewID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rating` decimal(2,1) NOT NULL DEFAULT '3.0',
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` mediumtext NOT NULL,
  `customerID` int(10) unsigned DEFAULT NULL,
  `productID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `customerID` (`customerID`),
  KEY `productID` (`productID`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `game` (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,5.0,'2018-03-24 20:59:09','Highly reccommend',2,2),(2,4.0,'2018-03-24 20:59:09','Fun and instruccional.',1,1),(3,4.0,'2018-03-24 20:59:09','It is a good game, but takes a really long time to play.',3,4);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping` (
  `custOrder` int(10) unsigned NOT NULL,
  `warehouseID` int(10) unsigned DEFAULT NULL,
  `carrierID` int(10) unsigned DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  KEY `custOrder` (`custOrder`),
  KEY `warehouseID` (`warehouseID`),
  KEY `carrierID` (`carrierID`),
  CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`custOrder`) REFERENCES `custOrder` (`custOrder`),
  CONSTRAINT `shipping_ibfk_2` FOREIGN KEY (`warehouseID`) REFERENCES `warehouse` (`warehouseID`),
  CONSTRAINT `shipping_ibfk_3` FOREIGN KEY (`carrierID`) REFERENCES `carrier` (`carrierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping`
--

LOCK TABLES `shipping` WRITE;
/*!40000 ALTER TABLE `shipping` DISABLE KEYS */;
INSERT INTO `shipping` VALUES (1,1,1,'pending'),(2,1,2,'pending'),(3,1,2,'pending'),(15,1,NULL,'pending'),(16,1,NULL,'pending'),(17,1,NULL,'pending'),(18,1,NULL,'pending'),(19,1,NULL,'pending'),(20,1,NULL,'pending'),(21,1,NULL,'canceled'),(26,1,NULL,'pending'),(27,1,NULL,'pending'),(28,1,NULL,'pending'),(29,1,NULL,'pending'),(30,1,NULL,'canceled'),(31,1,NULL,'pending'),(32,1,NULL,'pending');
/*!40000 ALTER TABLE `shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `supplierID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`supplierID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'Amazon','18015551234'),(2,'Boardgame Co','18015559876');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `loggedin` int(1) unsigned NOT NULL DEFAULT '0',
  `admin` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','7b4e0a2d0ba6fdbdf2523953958a63caed8a2d610ed529d22dcdf48eecd54596',0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse` (
  `warehouseID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `address` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` int(9) NOT NULL,
  PRIMARY KEY (`warehouseID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse`
--

LOCK TABLES `warehouse` WRITE;
/*!40000 ALTER TABLE `warehouse` DISABLE KEYS */;
INSERT INTO `warehouse` VALUES (1,'Orem UT','910 N Southstreet','Orem','UT',84702),(2,'Twin Falls ID','693 S Weststreet','Twin Falls','ID',70549);
/*!40000 ALTER TABLE `warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `custOrderSummary`
--

/*!50001 DROP TABLE IF EXISTS `custOrderSummary`*/;
/*!50001 DROP VIEW IF EXISTS `custOrderSummary`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`hmredford`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `custOrderSummary` AS select `custOrder`.`custOrder` AS `custOrder`,`custOrder`.`customerID` AS `customerID`,`customer`.`firstName` AS `firstName`,`customer`.`lastName` AS `lastName`,`game`.`name` AS `name`,`custOrderList`.`quantity` AS `quantity`,`custOrder`.`orderDate` AS `orderDate`,`custOrder`.`paymentMethod` AS `paymentMethod`,`custOrder`.`paymentTotal` AS `paymentTotal`,`custOrder`.`paymentDate` AS `paymentDate`,`shipping`.`status` AS `status` from ((((`custOrder` left join `custOrderList` on((`custOrder`.`custOrder` = `custOrderList`.`custOrder`))) join `game` on((`game`.`productID` = `custOrderList`.`productID`))) join `customer` on((`custOrder`.`customerID` = `customer`.`customerID`))) join `shipping` on((`custOrder`.`custOrder` = `shipping`.`custOrder`))) group by `custOrder`.`custOrder` order by `custOrder`.`orderDate` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-17 19:50:36
