DROP TABLE IF EXISTS PurchaseDetail;
DROP TABLE IF EXISTS Purchase;
DROP TABLE IF EXISTS Setting;
DROP TABLE IF EXISTS CategoryProduct;
DROP TABLE IF EXISTS ColorProduct;
DROP TABLE IF EXISTS StrapProduct;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Color;
DROP TABLE IF EXISTS Strap;
DROP TABLE IF EXISTS i18n;

CREATE USER 'webshop'@'127.0.0.1' IDENTIFIED BY '1234';GRANT USAGE ON *.* TO 'webshop'@'127.0.0.1' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `webshop`.* TO 'webshop'@'127.0.0.1';


CREATE TABLE Users
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
  isAdmin INT NOT NULL,
  PRIMARY KEY (UserID)
);

CREATE TABLE i18n
(
  i18nID INT NOT NULL AUTO_INCREMENT,
  text_en TEXT NOT NULL,
  text_de TEXT NOT NULL,
  PRIMARY KEY (i18nID)
);

CREATE TABLE Category
(
  CategoryID INT NOT NULL AUTO_INCREMENT,
  CategoryName INT NOT NULL,
  PRIMARY KEY (CategoryID),
  CONSTRAINT `FK_i18nCategoryName` FOREIGN KEY (CategoryName) REFERENCES i18n(i18nID)
);

CREATE TABLE Purchase
(
  PurchaseID INT NOT NULL AUTO_INCREMENT,
  PurchaseTimestamp INT NOT NULL,
  Description TEXT NOT NULL,
  PurchaseStatus ENUM('open','sent') NOT NULL,
  UserID INT NOT NULL,
  PRIMARY KEY (PurchaseID),
  CONSTRAINT `FK_PurchaseUser` FOREIGN KEY (UserID) REFERENCES Users(UserID)
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
  PRIMARY KEY (ColorID),
  CONSTRAINT `FK_i18nColorName` FOREIGN KEY (ColorName) REFERENCES i18n(i18nID)
);

CREATE TABLE Strap
(
  StrapID INT NOT NULL AUTO_INCREMENT,
  Strap INT NOT NULL,
  PRIMARY KEY (StrapID),
  CONSTRAINT `FK_i18nStrap` FOREIGN KEY (Strap) REFERENCES i18n(i18nID)
);

CREATE TABLE Product
(
  ProductID INT NOT NULL AUTO_INCREMENT,
  Productname VARCHAR(50) NOT NULL,
  Productdescription INT NOT NULL,
  BrandID INT NOT NULL,
  Price INT NOT NULL,
  PRIMARY KEY (ProductID),
  CONSTRAINT `FK_ProductBrand` FOREIGN KEY (BrandID) REFERENCES Brand(BrandID),
  CONSTRAINT `FK_i18nProductdescription` FOREIGN KEY (Productdescription) REFERENCES i18n(i18nID)
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

INSERT INTO Users(Prename,Surname,Password,Email,Address,City,ZIP,Country,isAdmin) VALUES (
	'Dario',
	'Furigo',
	'$2y$10$Lkx4m3PAGxs5uUi1qEMA0.cRl7PHatrzaKM6YkauEv3qLvynM5A4G',
	'dario.furigo@shemale.ch',
	'Wiehnachtstrasse 99',
	'Murg',
	'79730',
	'DE',
	0
);

INSERT INTO Users(Prename,Surname,Password,Email,Address,City,ZIP,Country,isAdmin) VALUES (
	'Beat',
	'Schaerz',
	'$2y$10$Lkx4m3PAGxs5uUi1qEMA0.cRl7PHatrzaKM6YkauEv3qLvynM5A4G',
	'beat.schaerz@hemale.ch',
	'Musterstrasse 99',
	'Wien',
	'1010',
	'AT',
	1
);

INSERT INTO i18n(text_en, text_de) VALUES
	('Men','Herren'),
	('Women','Damen'),
	('Smartwatches','Smartwatches'),
	('Dive Watches','Taucheruhren'),
	('Aviator Watches','Fliegeruhren'),
	('Dress Watches','Dress Uhren'),
	('Luxury Watches','Luxusuhren'),
	('Racing Watches','Rennuhren'),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('',''),
	('Gold Metal','Gold Metall'),
	('Silver Metal','Silber Metall'),
	('Rosegold Metal','Roségold Metall'),
	('White Plastic','Weiss Plastik'),
	('Black Plastic','Schwarz Plastik'),
	('Black Leather','Schwarz Leder'),
	('Brown Leather','Braun Leder'),
	('White Leather','Weiss Leder'),
	('Gold','Gold'),
	('Rosegold','Roségold'),
	('Silver','Silber'),
	('Black','Schwarz'),
	('Blue','Blau'),
	('Green','Grün'),
	('Brown', 'Braun'),
	('White', 'Weiss');

INSERT INTO Category(CategoryName) VALUES
	(1),(2),(3),(4),(5),(6),(7),(8);

INSERT INTO Brand(Brandname) VALUES
	('Rolex'),
	('Certina'),
	('Tissot'),
	('Breitling'),
	('Fossil'),
	('Hamilton');

INSERT INTO Product(Productname, Productdescription, BrandID, Price) VALUES
	('Fossil Q Venture Smartwatch', 9, 5, 10),
	('Fossil Q Grant Hybrid Smartwatch', 10, 5, 20),
	('Tissot PRC 200 Automatic Chronograph Gent', 11, 3, 30),
	('Certina DS Action Lady Precidrive', 12, 2, 40),
	('Rolex SUBMARINER', 13, 1, 50),
	('Rolex SUBMARINER DATE', 14, 1, 60),
	('Breitling NAVITIMER 1 B01 CHRONOGRAPH 46', 15, 4, 70),
	('Hamilton Khaki Pilot', 16, 6, 80),
	('Rolex SKY_DWELLER', 17, 1, 90),
	('Rolex YACHT-MASTER 37', 18, 1, 100),
	('Certina DS Podium Chronograph', 19, 2, 110),
	('Certina DS Podium Lady', 20, 2, 120),
	('Tissot Chemin Des Tourelles Squelette', 21, 3, 130),
	('Hamilton Jazzmaster Viewmatic Skeleton Lady', 22, 6, 140);

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
	(23),(24),(25),(26),(27),(28),(29),(30);

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
	(31),(32),(33),(34),(35),(36),(37),(38);

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
