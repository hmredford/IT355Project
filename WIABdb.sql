CREATE TABLE game(
	productID int NOT NULL AUTO_INCREMENT,
	name varchar(255),
	publisher varchar(255),
	collection varchar(255),
	releaseDate date,
	numPlayers int,
	playtime int,
	ageRating varchar(255),
	description text,
	imagePath varchar(255),
	themes varchar(255),
	designer varchar(255),
	mechanics varchar(255),
	PRIMARY KEY (productID)
);

CREATE TABLE customer(
	customerID int NOT NULL AUTO_INCREMENT,
	username varchar(255),
	password varchar(255),
	firstName varchar(255),
	lastName varchar(255),
	email varchar(255),
	address varchar(255),
	city varchar(255),
	state varchar(255),
	zip int;
	PRIMARY KEY (customerID)
);

CREATE TABLE review(
	reviewID int NOT NULL AUTO_INCREMENT,
	rating tinyint(8),
	reviewDate date,
	comment text,
	customerID int,
	productID int,
	PRIMARY KEY (reviewID),
	FOREIGN KEY (customerID) REFERENCES customer(customerID),
	FOREIGN KEY (productID) REFERENCES product(productID)
);

CREATE TABLE reviewImage(
	reviewID int NOT NULL,
	imagePath varchar(255),
	altText varchar(255),
	FOREIGN KEY (reviewID) REFERENCES review(reviewID)
);

CREATE TABLE custOrder(
	custOrder int NOT NULL AUTO_INCREMENT,
	orderDate date,
	paymentMethod varchar(255),
	paymentTotal int,
	paymentDate date,
	CustomerID int,
	PRIMARY KEY (custOrder),
	FOREIGN KEY (customerID) REFERENCES customer(customerID)
);

CREATE TABLE custOrderList(
	custOrder int,
	productID int,
	FOREIGN KEY (custOrder) REFERENCES custOrder(custOrder)
);

CREATE TABLE shipping(
	custOrder int,
	warehouseID int,
	carrierID int,
	status varchar(255),
	FOREIGN KEY (custOrder) REFERENCES custOrder(custOrder),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID),
	FOREIGN KEY (carrierID) REFERENCES carrier(carrierID)
);

CREATE TABLE supplier(
	supplierID int NOT NULL AUTO_INCREMENT,
	name varchar(255),
	phone int,
	PRIMARY KEY (supplierID)
);

CREATE TABLE merchOrder(
	merchOrder int NOT NULL AUTO_INCREMENT,
	orderDate date,
	paymentMethod varchar(255),
	paymentTotal int,
	Payment_Date varchar(255),
	employeeID int,
	FOREIGN KEY (employeeID) REFERENCES employee(employeeID)
);

CREATE TABLE merchOrderList(
	merchOrder int,
	productID int,
	FOREIGN KEY (merchOrder) REFERENCES merchOrder(merchOrder),
	FOREIGN KEY (productID) REFERENCES product(productID)
);

CREATE TABLE receiving (
	merchOrder int,
	warehouseID int,
	carrierID int,
	status varchar(255),
	FOREIGN KEY (merchOrder) REFERENCES merchOrder(merchOrder),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID),
	FOREIGN KEY (carrierID) REFERENCES carrier(carrierID)
);

CREATE TABLE inventory(
	productID int,
	warehouseID int,
	quantity int,
	FOREIGN KEY (productID) REFERENCES product(productID),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID)
);

CREATE TABLE employee(
	employeeID intNOT NULL AUTO_INCREMENT(100),
	firstName varchar(255),
	lastName varchar (255),
	hireDate date,
	phone int,
	email int,
	address varchar(255),
	city varchar(255),
	state varchar(255),
	zip int,
	warehouseID int,
	position varchar(255),
	supervisorID int,
	PRIMARY KEY (employeeID),
	FOREIGN KEY (warehouseID) REFERENCES warehouse(warehouseID),
	FOREIGN KEY (supervisorID) REFERENCES employee(employeeID)
	);

CREATE TABLE warehouse(
	warehouseID int NOT NULL AUTO_INCREMENT,
	name varchar(255),
	address varchar(255),
	city varchar(255),
	state varchar(255), 
	zip int,
	managerID int,
	PRIMARY KEY(warehouseID),
	FOREIGN KEY (managerID) REFERENCES employee(employeeID)
);

CREATE TABLE carrier(
	carrierID int,
	name varchar(255),
	phone int,
	PRIMARY KEY(carrierID)
);

