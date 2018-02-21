CREATE TABLE customer(
	CustomerID int;
	Username varchar(255);
	FirstName varchar(255);
	LastName varchar(255);
	Email varchar(255);
	StreetAddress varchar(255);
	AptNumber int; 
	City varchar(255);
	State varchar(255);
	Zip int;
);

CREATE TABLE game(
	Product ID int;
	Name varchar(255);
	Publisher varchar(255);
	Collection varchar(255);
	ReleaseDate date;
	NumPlayers int;
	PlayTime int;
	AgeRating varchar(255);
	Description varchar(4095);
	ImagePath varchar(255);
	Themes varchar(255);
	Designer varchar(255);
	Artist varchar(255);
	Mechanics varchar(255);
);
