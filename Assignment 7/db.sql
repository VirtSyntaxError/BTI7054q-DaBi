CREATE TABLE User
(
  UserID INT NOT NULL,
  Prename VARCHAR(50) NOT NULL,
  Surname VARCHAR(50) NOT NULL,
  Password CHAR(64) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Address VARCHAR(50) NOT NULL,
  City VARCHAR(50) NOT NULL,
  ZIP INT NOT NULL,
  PRIMARY KEY (UserID),
  UNIQUE (Email)
);

CREATE TABLE Category
(
  CategoryID INT NOT NULL,
  CategoryName VARCHAR(50) NOT NULL,
  PRIMARY KEY (CategoryID)
);

CREATE TABLE Order
(
  OrderID INT NOT NULL,
  OrderTimestamp INT NOT NULL,
  Description TEXT NOT NULL,
  OrderStatus ENUM('open','sent') NOT NULL,
  UserID INT NOT NULL,
  PRIMARY KEY (OrderID),
  FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Brand
(
  BrandID INT NOT NULL,
  Brandname VARCHAR(50) NOT NULL,
  PRIMARY KEY (BrandID)
);

CREATE TABLE Setting
(
  SettingID INT NOT NULL,
  SettingName VARCHAR(50) NOT NULL,
  SettingValue VARCHAR(50) NOT NULL,
  PRIMARY KEY (SettingID)
);

CREATE TABLE Color
(
  ColorID INT NOT NULL,
  ColorName INT NOT NULL,
  PRIMARY KEY (ColorID)
);

CREATE TABLE Strap
(
  StrapID INT NOT NULL,
  Strap VARCHAR(50) NOT NULL,
  PRIMARY KEY (StrapID)
);

CREATE TABLE Product
(
  ProductID INT NOT NULL,
  Productname VARCHAR(50) NOT NULL,
  Productdescription TEXT NOT NULL,
  BrandID INT NOT NULL,
  PRIMARY KEY (ProductID),
  FOREIGN KEY (BrandID) REFERENCES Brand(BrandID)
);

CREATE TABLE OrderDetail
(
  Count INT NOT NULL,
  ProductID INT NOT NULL,
  OrderID INT NOT NULL,
  PRIMARY KEY (ProductID, OrderID),
  FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  FOREIGN KEY (OrderID) REFERENCES Order(OrderID)
);

CREATE TABLE CategoryProduct
(
  ProductID INT NOT NULL,
  CategoryID INT NOT NULL,
  PRIMARY KEY (ProductID, CategoryID),
  FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

CREATE TABLE ColorProduct
(
  ProductID INT NOT NULL,
  ColorID INT NOT NULL,
  PRIMARY KEY (ProductID, ColorID),
  FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  FOREIGN KEY (ColorID) REFERENCES Color(ColorID)
);

CREATE TABLE StrapProduct
(
  ProductID INT NOT NULL,
  StrapID INT NOT NULL,
  PRIMARY KEY (ProductID, StrapID),
  FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  FOREIGN KEY (StrapID) REFERENCES Strap(StrapID)
);
