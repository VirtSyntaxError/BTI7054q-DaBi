use webshop;

DROP TABLE IF EXISTS PurchaseDetail;
DROP TABLE IF EXISTS Purchase;
DROP TABLE IF EXISTS Setting;
DROP TABLE IF EXISTS CategoryProduct;
DROP TABLE IF EXISTS ColorProduct;
DROP TABLE IF EXISTS StrapProduct;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Color;
DROP TABLE IF EXISTS Strap;


CREATE TABLE User
(
  UserID INT NOT NULL AUTO_INCREMENT,
  Prename VARCHAR(50) NOT NULL,
  Surname VARCHAR(50) NOT NULL,
  Password CHAR(64) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Address VARCHAR(50) NOT NULL,
  City VARCHAR(50) NOT NULL,
  ZIP INT NOT NULL,
  Country VARCHAR(2) NOT NULL,
  PRIMARY KEY (UserID)
);

CREATE TABLE Category
(
  CategoryID INT NOT NULL AUTO_INCREMENT,
  CategoryName VARCHAR(50) NOT NULL,
  PRIMARY KEY (CategoryID)
);

CREATE TABLE Purchase
(
  PurchaseID INT NOT NULL AUTO_INCREMENT,
  PurchaseTimestamp INT NOT NULL,
  Description TEXT NOT NULL,
  PurchaseStatus ENUM('open','sent') NOT NULL,
  UserID INT NOT NULL,
  PRIMARY KEY (PurchaseID),
  CONSTRAINT `FK_PurchaseUser` FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Brand
(
  BrandID INT NOT NULL AUTO_INCREMENT,
  Brandname VARCHAR(50) NOT NULL,
  PRIMARY KEY (BrandID)
);

CREATE TABLE Setting
(
  SettingID INT NOT NULL AUTO_INCREMENT,
  SettingName VARCHAR(50) NOT NULL,
  SettingValue VARCHAR(50) NOT NULL,
  PRIMARY KEY (SettingID)
);

CREATE TABLE Color
(
  ColorID INT NOT NULL AUTO_INCREMENT,
  ColorName INT NOT NULL,
  PRIMARY KEY (ColorID)
);

CREATE TABLE Strap
(
  StrapID INT NOT NULL AUTO_INCREMENT,
  Strap VARCHAR(50) NOT NULL,
  PRIMARY KEY (StrapID)
);

CREATE TABLE Product
(
  ProductID INT NOT NULL AUTO_INCREMENT,
  Productname VARCHAR(50) NOT NULL,
  Productdescription TEXT NOT NULL,
  BrandID INT NOT NULL,
  PRIMARY KEY (ProductID),
  CONSTRAINT `FK_ProductBrand` FOREIGN KEY (BrandID) REFERENCES Brand(BrandID)
);

CREATE TABLE PurchaseDetail
(
  Count INT NOT NULL,
  ProductID INT NOT NULL,
  PurchaseID INT NOT NULL,
  PRIMARY KEY (ProductID, PurchaseID),
  CONSTRAINT `FK_PurchaseDetailProduct` FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  CONSTRAINT `FK_PurchaseDetailPurchase` FOREIGN KEY (PurchaseID) REFERENCES Purchase(PurchaseID)
);

CREATE TABLE CategoryProduct
(
  ProductID INT NOT NULL,
  CategoryID INT NOT NULL,
  PRIMARY KEY (ProductID, CategoryID),
  CONSTRAINT `FK_CategoryProductProduct` FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  CONSTRAINT `FK_CategoryProductCategory` FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

CREATE TABLE ColorProduct
(
  ProductID INT NOT NULL,
  ColorID INT NOT NULL,
  PRIMARY KEY (ProductID, ColorID),
  CONSTRAINT `FK_ColorProductProduct` FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  CONSTRAINT `FK_ColorProductColor` FOREIGN KEY (ColorID) REFERENCES Color(ColorID)
);

CREATE TABLE StrapProduct
(
  ProductID INT NOT NULL,
  StrapID INT NOT NULL,
  PRIMARY KEY (ProductID, StrapID),
  CONSTRAINT `FK_StrapProductProduct` FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  CONSTRAINT `FK_StrapProductStrap` FOREIGN KEY (StrapID) REFERENCES Strap(StrapID)
);

INSERT INTO User(Prename,Surname,Password,Email,Address,City,ZIP,Country) VALUES (
	'Dario',
	'Furigo',
	'3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2',
	'dario.furigo@shemale.ch',
	'Wiehnachtstrasse 99',
	'Murg',
	'79730',
	'DE'
);

INSERT INTO User(Prename,Surname,Password,Email,Address,City,ZIP,Country) VALUES (
	'Beat',
	'Schärz',
	'3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2',
	'beat.schaerz@hemale.ch',
	'Musterstrasse 99',
	'Wien',
	'1010',
	'AT'
);

INSERT INTO Category(CategoryName) VALUES
	('Men'),
	('Women'),
	('Smartwatches'),
	('Dive Watches'),
	('Aviator Watches'),
	('Dress Watches'),
	('Luxury Watches'),
	('Racing Watches');

INSERT INTO Brand(Brandname) VALUES
	('Rolex'),
	('Certina'),
	('Tissot'),
	('Breitling'),
	('Fossil'),
	('Hamilton');

INSERT INTO Product(Productname, Productdescription, BrandID) VALUES
	('Fossil Q Venture Smartwatch', '', 5),
	('Fossil Q Grant Hybrid Smartwatch', '', 5),
	('Tissot PRC 200 Automatic Chronograph Gent', '', 3),
	('Certina DS Action Lady Precidrive', '', 2),
	('Rolex SUBMARINER', '', 1),
	('Rolex SUBMARINER DATE', '', 1),
	('Breitling NAVITIMER 1 B01 CHRONOGRAPH 46', '', 4),
	('Hamilton Khaki Pilot', '', 6),
	('Rolex SKY_DWELLER', '', 1),
	('Rolex YACHT-MASTER 37', '', 1),
	('Certina DS Podium Chronograph', '', 2),
	('Certina DS Podium Lady', '', 2),
	('Tissot Chemin Des Tourelles Squelette', '', 3),
	('Hamilton Jazzmaster Viewmatic Skeleton Lady', '', 6);

INSERT INTO CategoryProduct(ProductID, CategoryID) VALUES
	(1,3),(1,1),(1,2),
	(2,3),(2,1),
	(3,4),(3,1),
	(4,4),(4,2),
	(5,4),(5,1),
	(6,4),(6,1),
	(7,5),(7,1),
	(8,5),(8,1),
	(9,6),(9,1),
	(10,6),(10,2),
	(11,8),(11,1),
	(12,8),(12,2),
	(13,7),(13,1),
	(14,7),(14,2);

INSERT INTO Strap(Strap) VALUES
	('Gold Metal'),
	('Silver Metal'),
	('Rosegold Metal'),
	('White Plastic'),
	('Black Plastic'),
	('Black Leather'),
	('Brown Leather'),
	('White Leather');

INSERT INTO StrapProduct(ProductID, StrapID) VALUES
	(1,1),(1,2),(1,3),
	(2,7),
	(3,2),(3,5),(3,6),
	(4,2),(4,4),(4,5),
	(5,2),
	(6,2),
	(7,2),(7,6),(7,7),
	(8,7),(8,2),
	(9,2),
	(10,2),(10,5),
	(11,2),(11,7),
	(12,2),(12,1),(12,7),(12,8),
	(13,6),(13,2),
	(14,2),(14,8),(14,7);

INSERT INTO Color(ColorName) VALUES
	('Gold'),
	('Rosegold'),
	('Silver'),
	('Black'),
	('Blue'),
	('Green'),
	('Brown'),
	('White');

INSERT INTO ColorProduct(ProductID, ColorID) VALUES
	(1,1),(1,2),(1,3),
	(2,5),
	(3,3),(3,4),
	(4,3),(4,4),
	(5,4),
	(6,5),(6,6),
	(7,2),(7,3),(7,4),
	(8,3),(8,4),
	(9,5),(9,3),(9,4),
	(10,2),(10,4),(10,3),
	(11,3),(11,5),(11,4),
	(12,2),(12,3),(12,7),
	(13,5),(13,2),
	(14,8),(14,3),(14,1);
