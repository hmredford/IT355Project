CREATE TABLE IF NOT EXISTS game(
	productID int unsigned NOT NULL AUTO_INCREMENT,
	name varchar(128) NOT NULL DEFAULT '',
	publisher varchar(128) NOT NULL DEFAULT '',
	collection varchar(128) DEFAULT '',
	releaseDate date,
	numPlayers int(2) unsigned NOT NULL DEFAULT 2,
	playtime int(3) unsigned DEFAULT 30,
	ageRating varchar(64) NOT NULL DEFAULT '8+',
	description mediumtext NOT NULL DEFAULT '',
	imagePath varchar(128) NOT NULL DEFAULT '',
	themes varchar(128) NOT NULL DEFAULT '',
	designer varchar(128) NOT NULL DEFAULT '',
	mechanics varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (productID)
);

CREATE TABLE IF NOT EXISTS customer(
	customerID int unsigned NOT NULL AUTO_INCREMENT,
	username varchar(16) NOT NULL,
	password varchar(32) NOT NULL,
	firstName varchar(16)NOT NULL,
	lastName varchar(16) NOT NULL,
	email varchar(255) NOT NULL,
	address varchar(32) NOT NULL,
	city varchar(32) NOT NULL,
	state char(2) NOT NULL,
	zip int(9) NOT NULL,
	PRIMARY KEY (customerID)
);

CREATE TABLE IF NOT EXISTS review(
	reviewID int unsigned NOT NULL AUTO_INCREMENT,
	rating float(1,1) NOT NULL DEFAULT '3.0',
	reviewDate timestamp NOT NULL,
	comment mediumtext NOT NULL DEFAULT '',
	customerID int unsigned,
	productID int unsigned,
	PRIMARY KEY (reviewID),
	FOREIGN KEY (customerID) REFERENCES customer(customerID),
	FOREIGN KEY (productID) REFERENCES game(productID)
);


CREATE TABLE IF NOT EXISTS custOrder(
	custOrder int unsigned NOT NULL AUTO_INCREMENT,
	orderDate timestamp NOT NULL,
	paymentMethod varchar(255) NOT NULL,
	paymentTotal float(16,2) NOT NULL,
	paymentDate timestamp,
	customerID int unsigned NOT NULL,
	PRIMARY KEY (custOrder),
	FOREIGN KEY (customerID) REFERENCES customer(customerID)
);

CREATE TABLE IF NOT EXISTS custOrderList(
	custOrder int unsigned NOT NULL,
	productID int unsigned NOT NULL,
	quantity int (2) unsigned NOT NULL DEFAULT 1,
	FOREIGN KEY (custOrder) REFERENCES custOrder(custOrder)
);


CREATE TABLE IF NOT EXISTS supplier(
	supplierID int unsigned NOT NULL AUTO_INCREMENT,
	name varchar(64) NOT NULL,
	phone int(11),
	PRIMARY KEY (supplierID)
);

CREATE TABLE IF NOT EXISTS warehouse(
	warehouseID int unsigned NOT NULL AUTO_INCREMENT,
	name varchar(32) NOT NULL,
	address varchar(32) NOT NULL,
	city varchar(32) NOT NULL,
	state char(2) NOT NULL, 
	zip int(9) NOT NULL,
	PRIMARY KEY(warehouseID)
);


CREATE TABLE IF NOT EXISTS employee(
	employeeID int unsigned NOT NULL AUTO_INCREMENT,
	firstName varchar(32) NOT NULL,
	lastName varchar (32) NOT NULL,
	hireDate date NOT NULL,
	phone int(11) unsigned,
	email varchar(255) NOT NULL,
	address varchar(32) NOT NULL,
	city varchar(32) NOT NULL,
	state char(2) NOT NULL,
	zip int(9) NOT NULL,
	warehouseID int unsigned,
	position varchar(32),
	PRIMARY KEY (employeeID),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID)
	);


CREATE TABLE IF NOT EXISTS carrier(
	carrierID int unsigned NOT NULL AUTO_INCREMENT,
	name varchar(64) NOT NULL,
	phone int(11),
	PRIMARY KEY(carrierID)
);


CREATE TABLE IF NOT EXISTS merchOrder(
	merchOrder int unsigned NOT NULL AUTO_INCREMENT,
	orderDate timestamp NOT NULL,
	paymentMethod varchar(255) NOT NULL,
	paymentTotal float(16,2) NOT NULL,
	Payment_Date timestamp,
	employeeID int unsigned NOT NULL,
	PRIMARY KEY (merchOrder),
	FOREIGN KEY (employeeID) REFERENCES employee(employeeID)
);

CREATE TABLE IF NOT EXISTS merchOrderList(
	merchOrder int unsigned NOT NULL,
	productID int unsigned NOT NULL,
	quantity int(2) unsigned NOT NULL DEFAULT 1,
	FOREIGN KEY (merchOrder) REFERENCES merchOrder(merchOrder),
	FOREIGN KEY (productID) REFERENCES game(productID)
);

CREATE TABLE IF NOT EXISTS shipping(
	custOrder int unsigned NOT NULL,
	warehouseID int unsigned NOT NULL,
	carrierID int unsigned,
	status varchar(255) NOT NULL DEFAULT 'Pending',
	FOREIGN KEY (custOrder) REFERENCES custOrder(custOrder),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID),
	FOREIGN KEY (carrierID) REFERENCES carrier(carrierID)
);


CREATE TABLE IF NOT EXISTS receiving (
	merchOrder int unsigned NOT NULL,
	warehouseID int unsigned NOT NULL,
	carrierID int unsigned,
	status varchar(128) NOT NULL DEFAULT 'Pending',
	FOREIGN KEY (merchOrder) REFERENCES merchOrder(merchOrder),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID),
	FOREIGN KEY (carrierID) REFERENCES carrier(carrierID)
);

CREATE TABLE IF NOT EXISTS inventory(
	productID int unsigned NOT NULL,
	warehouseID int unsigned NOT NULL,
	quantity int(2) unsigned NOT NULL DEFAULT 1,
	FOREIGN KEY (productID) REFERENCES game(productID),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID)
);