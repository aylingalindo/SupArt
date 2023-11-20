CREATE DATABASE supart;
USE supart;
CREATE TABLE rol(
	 rolID	INT AUTO_INCREMENT PRIMARY KEY
	,rol	VARCHAR(20)
);

CREATE TABLE users(
	userID		INT AUTO_INCREMENT PRIMARY KEY
	,email		VARCHAR(100)
	,username	VARCHAR(50)
	,password	VARCHAR(50)
	,rol		INT
	,image		Blob
	,name		VARCHAR(50)
	,lastnameP	VARCHAR(50)
	,lastnameM	VARCHAR(50)
	,birthday	TIMESTAMP NULL
	,gender		VARCHAR(30) 
	,joinedDate	TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	,visibility	Boolean
	,FOREIGN KEY (rol) REFERENCES Rol(rolID)
);

CREATE TABLE products(
	 productID	INT AUTO_INCREMENT PRIMARY KEY
	,stock		INT
	,name		VARCHAR(50)
	,description	VARCHAR(200)
	,pricingType	ENUM('Sell', 'Negotiable') NOT NULL DEFAULT 'Negotiable'
	,price		DECIMAL(10,2)
	,review		DECIMAL(2,2)
	,approvedBy	INT 
	,uploadedBy	INT
	,FOREIGN KEY(approvedBy) REFERENCES users(userID)
	,FOREIGN KEY(uploadedBy) REFERENCES users(userID)	
);
ALTER TABLE products ADD COLUMN category int;

ALTER TABLE products
ADD CONSTRAINT fk_category
FOREIGN KEY (category)
REFERENCES category(categoryID);

CREATE TABLE mediaFilesProducts(
	 mediaProductsID	INT AUTO_INCREMENT PRIMARY KEY
	 ,product			INT
	 ,file				BLOB 
	,FOREIGN KEY (product) REFERENCES products(productID)
);

CREATE TABLE reviews(
	 reviewID		INT AUTO_INCREMENT PRIMARY KEY
	,product 		INT
	,score			INT
	,user			INT
	,comment		VARCHAR(200)
	,FOREIGN KEY(product) REFERENCES products(productID)
	,FOREIGN KEY(user) REFERENCES users(userID)
);

ALTER TABLE reviews
ADD COLUMN purchaseID INT,
ADD CONSTRAINT fk_purchaseID
    FOREIGN KEY (purchaseID)
    REFERENCES purchaseinfo(purchaseID);


CREATE TABLE cart(
	 cartID			INT AUTO_INCREMENT PRIMARY KEY
	,product		INT 
	,numItems		INT
	,user			INT
	,FOREIGN KEY (product) REFERENCES products(productID)
	,FOREIGN KEY (user) REFERENCES users (userID)
);

CREATE TABLE purchaseInfo(
	 purchaseID		INT AUTO_INCREMENT PRIMARY KEY
	,product		 INT
	,purchaseDate	 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	,user			INT
	,total			DECIMAL(10,2)
	,numItems		INT
	,FOREIGN KEY (product) REFERENCES products(productID)
	,FOREIGN KEY(user) REFERENCES users(userID)
);

ALTER TABLE purchaseinfo ADD COLUMN folio INT;
ALTER TABLE purchaseinfo ADD COLUMN purchID INT;

ALTER TABLE purchaseinfo
ADD CONSTRAINT fk_purchs
FOREIGN KEY (purchID)
REFERENCES purchase(purchaseID);

CREATE TABLE pricing(
	 pricingID		INT AUTO_INCREMENT PRIMARY KEY
	,product 		INT
	,approval		boolean
	,user			INT
	,FOREIGN KEY (product) REFERENCES products(productID)
	,FOREIGN KEY(user) REFERENCES users(userID)
);

CREATE TABLE lists(
	 listID			INT AUTO_INCREMENT PRIMARY KEY
	,name			VARCHAR(50)
	,description		VARCHAR(200)
	,user			INT
,FOREIGN KEY(user) REFERENCES users(userID)
);

CREATE TABLE mediaFilesList(
	 mediaListID		INT AUTO_INCREMENT PRIMARY KEY
	,list			INT
	,file			BLOB
	,FOREIGN KEY (list) REFERENCES lists(listID)
);

CREATE TABLE listItems(
	 listItemID		INT AUTO_INCREMENT PRIMARY KEY
	,list			INT
	,product		INT
	,FOREIGN KEY (list) REFERENCES lists(listID)
	,FOREIGN KEY (product) REFERENCES products(productID)
);

CREATE TABLE category(
	 categoryID		INT AUTO_INCREMENT PRIMARY KEY
	,name			 VARCHAR(50)
	,description	 VARCHAR(200)
	,user			 INT
	,FOREIGN KEY(user) REFERENCES users(userID)
);

CREATE TABLE product_category(
	 productCatID	INT AUTO_INCREMENT PRIMARY KEY
	,category		INT
	,product 		 INT
	,FOREIGN KEY (category) REFERENCES category(categoryID)
	,FOREIGN KEY (product) REFERENCES products(productID)
);

CREATE TABLE userMessages (
    messageID	INT AUTO_INCREMENT PRIMARY KEY,
    senderID	INT,
    receiverID	INT,
    message		TEXT,
	product		INT
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (senderID) REFERENCES users(userID),
    FOREIGN KEY (receiverID) REFERENCES users(userID),
    FOREIGN KEY (product) REFERENCES products(productID)
);

CREATE TABLE purchase (
	purchaseID		INT AUTO_INCREMENT PRIMARY KEY,
	id_transaction	VARCHAR(20),
	purchaseDate	DATETIME,
	status			VARCHAR(20),
	id_cliente		INT,
	total			DECIMAL(10,2)
);