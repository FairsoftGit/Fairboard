# Create database

CREATE DATABASE sightvision_fairsoft;
USE sightvision_fairsoft;


# Remove existing tables
DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS account_role;
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS company;
DROP TABLE IF EXISTS country;
DROP TABLE IF EXISTS email;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS `order`;
DROP TABLE IF EXISTS `order_seq`;
DROP TABLE IF EXISTS orderline;
DROP TABLE IF EXISTS orderline_seq;
DROP TABLE IF EXISTS permission;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS phonenr;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS relation;
DROP TABLE IF EXISTS relation_seq;
DROP TABLE IF EXISTS relation_address;
DROP TABLE IF EXISTS rent;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS role_permission;
DROP TABLE IF EXISTS subscription;

# Create tables
CREATE TABLE account(
	Username VARCHAR(100) UNIQUE NOT NULL,
   `Password` VARCHAR(255) NOT NULL,
   status TINYINT DEFAULT 1 NOT NULL,
   RELATIONRelationNumber VARCHAR(15) NOT NULL,
    
   CONSTRAINT accountPK PRIMARY KEY (Username)  
);

CREATE TABLE account_role (
	ACCOUNTUsername VARCHAR(100) NOT NULL,
   ROLERole VARCHAR(100) NOT NULL,
    
   CONSTRAINT account_rolePK PRIMARY KEY (ACCOUNTUsername, ROLERole)
);

CREATE TABLE address (
	Street VARCHAR(100) NOT NULL,
   Housenumber VARCHAR(10) NOT NULL,
   Postcode VARCHAR(15) NOT NULL,
   City VARCHAR()50 NOT NULL,
   Province VARCHAR(30),
   CountryCode CHAR(2) NOT NULL,
   TypeOfAddress VARCHAR(10) NOT NULL,
    
   CONSTRAINT addressPK PRIMARY KEY (Street, Housenumber, Postcode)
);

CREATE TABLE company (
	`Name` VARCHAR(60) UNIQUE NOT NULL,
	IsSupplier CHAR(1) NOT NULL,
   RELATIONRelationNumber VARCHAR(15),
    
   CONSTRAINT companyPK PRIMARY KEY (RELATIONRelationNumber)
);

CREATE TABLE country (
	code CHAR(2) NOT NULL,
	name_dutch VARCHAR(100) NOT NULL,
	
	CONSTRAINT countryPK PRIMARY KEY (code)
);

CREATE TABLE email(
	Emailaddress VARCHAR(50) NOT NULL,
   RELATIONRelationNumber VARCHAR(15) NOT NULL,
    
   CONSTRAINT emailPK PRIMARY KEY (Emailaddress, RELATIONRelationNumber)
);

CREATE TABLE item(
	SerialNumber VARCHAR(50) UNIQUE NOT NULL,
   PRODUCTProductID VARCHAR(50) NOT NULL,
    
   CONSTRAINT itemPK PRIMARY KEY (SerialNumber)
);

CREATE TABLE `order`(
	OrderID VARCHAR(15) DEFAULT '0' UNIQUE NOT NULL,
   OrderDate DATETIME NOT NULL,
   ACCOUNTUsername VARCHAR(100) NOT NULL,
    
   CONSTRAINT orderPK PRIMARY KEY (OrderID)
);

CREATE TABLE orderline(
	OrderlineID VARCHAR(15) DEFAULT '0' UNIQUE NOT NULL,
   ORDEROrderID VARCHAR(15) NOT NULL,
   ITEMSerialNumber VARCHAR(50),
    
   CONSTRAINT orderlinePK PRIMARY KEY (OrderlineID)
);

CREATE TABLE permission(
	Permission VARCHAR(255) UNIQUE NOT NULL,
    
   CONSTRAINT permissionPK PRIMARY KEY (Permission)
);

CREATE TABLE person(
	`Name` VARCHAR(50) NOT NULL,
   LastName VARCHAR(60) NOT NULL,
   MiddleName VARCHAR(10),
   Gender CHAR(1),
   BirthDate DATE NOT NULL,
   RELATIONRelationNumber VARCHAR(15) NOT NULL UNIQUE,
    
   CONSTRAINT personPK PRIMARY KEY (RELATIONRelationNumber)
);

CREATE TABLE phonenr(
	Phonenumber VARCHAR(25) NOT NULL,
   RELATIONRelationNumber VARCHAR(15) NOT NULL,
    
   CONSTRAINT phonenrPK PRIMARY KEY (Phonenumber, RELATIONRelationNumber)
);

CREATE TABLE product(
	ProductID VARCHAR(50) UNIQUE NOT NULL,
   ProductName VARCHAR(255) NOT NULL,
   ProductDesc TEXT,
   PurchasePrice DECIMAL(19,2) NOT NULL,
   SalesPrice DECIMAL(19,2) NOT NULL,
   RentalPrice DECIMAL(19,2),
   COMPANYRELATIONRelationNumber VARCHAR(15),
    
   CONSTRAINT productPK PRIMARY KEY (ProductID)
);

CREATE TABLE relation(
	RelationNumber VARCHAR(15) DEFAULT '0' NOT NULL, #see table relation_seq
   RelationType VARCHAR(15) NOT NULL,
   IsActive CHAR(1) DEFAULT 'Y' NOT NULL,
   
   CONSTRAINT relationPK PRIMARY KEY (RelationNumber)
);

CREATE TABLE relation_address(
	RELATIONRelationNumber VARCHAR(15) NOT NULL,
   ADDRESSStreet VARCHAR(100) NOT NULL,
   ADDRESSHousenumber VARCHAR(10) NOT NULL,
   ADDRESSPostcode VARCHAR(15) NOT NULL,
   
   CONSTRAINT rel_addPK PRIMARY KEY (RELATIONRelationNumber, ADDRESSStreet, ADDRESSHousenumber, ADDRESSPostcode)
);

CREATE TABLE rent(
	ORDERLINEOrderlineID VARCHAR(15) NOT NULL,
   ITEMSerialNumber VARCHAR(50) NOT NULL,
   StartDate DATETIME NOT NULL,
   EndDate DATETIME NOT NULL,
    
   CONSTRAINT rentPK PRIMARY KEY (ORDERLINEOrderlineID)
);

CREATE TABLE role(
	Role VARCHAR(100) UNIQUE NOT NULL,
    
   CONSTRAINT rolePK PRIMARY KEY (Role)
);

CREATE TABLE role_permission(
	ROLERole VARCHAR(100) NOT NULL,
   PERMISSIONPermission VARCHAR(255) NOT NULL,
    
   CONSTRAINT role_permPK PRIMARY KEY (ROLERole, PERMISSIONPermission)
);

CREATE TABLE subscription(
	ORDERLINEOrderlineID VARCHAR(15) NOT NULL,
   ITEMSerialNumber VARCHAR(50) NOT NULL,
   StartDate DATETIME NOT NULL,
   EndDate DATETIME NOT NULL,
    
   CONSTRAINT subscriptionPK PRIMARY KEY (ORDERLINEOrderlineID)
);



### ADD FK CONSTRAINTS TO TABLES ###

ALTER TABLE account
ADD CONSTRAINT accountFK FOREIGN KEY (RELATIONRelationNumber) 
	REFERENCES relation (RelationNumber) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT;
        
ALTER TABLE account_role
ADD CONSTRAINT acc_rolFK FOREIGN KEY (AccountUsername) 
	REFERENCES account (Username) 
		ON UPDATE CASCADE 
		ON DELETE CASCADE,
ADD CONSTRAINT rol_accFK FOREIGN KEY (ROLERole)
	REFERENCES role (Role)
		ON UPDATE CASCADE
      ON DELETE CASCADE;

ALTER TABLE address
ADD CONSTRAINT addressFK FOREIGN KEY (CountryCode) 
	REFERENCES country (code) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT;

ALTER TABLE company
ADD CONSTRAINT companyFK FOREIGN KEY (RELATIONRelationNumber) 
	REFERENCES relation (RelationNumber) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT;

ALTER TABLE email
ADD CONSTRAINT emailFK FOREIGN KEY (RELATIONRelationNumber) 
	REFERENCES relation (RelationNumber) 
		ON UPDATE CASCADE 
		ON DELETE CASCADE;
        
ALTER TABLE item
ADD CONSTRAINT itemFK FOREIGN KEY (PRODUCTProductID) 
	REFERENCES product (ProductID) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT;
        
ALTER TABLE `order`
ADD CONSTRAINT orderFK FOREIGN KEY (ACCOUNTUsername) 
	REFERENCES account (Username) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT;
        
ALTER TABLE orderline
ADD CONSTRAINT orderlineFK1 FOREIGN KEY (ORDEROrderID) 
	REFERENCES `order` (OrderID) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT,
ADD CONSTRAINT orderlineFK2 FOREIGN KEY (ITEMSerialNumber)
	REFERENCES item (SerialNumber)
		ON UPDATE CASCADE
        ON DELETE RESTRICT;
        
ALTER TABLE person
ADD CONSTRAINT personFK FOREIGN KEY (RELATIONRelationNumber) 
	REFERENCES relation (RelationNumber) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT;
        
ALTER TABLE phonenr
ADD CONSTRAINT phonenrFK FOREIGN KEY (RELATIONRelationNumber) 
	REFERENCES relation (RelationNumber) 
		ON UPDATE CASCADE 
		ON DELETE CASCADE;
        
ALTER TABLE product
ADD CONSTRAINT productFK FOREIGN KEY (COMPANYRELATIONRelationNumber) 
	REFERENCES company (RELATIONRelationNumber) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT;
        
ALTER TABLE relation_address
ADD CONSTRAINT rel_addFK FOREIGN KEY (RELATIONRelationNumber) 
	REFERENCES relation (RelationNumber) 
		ON UPDATE CASCADE 
		ON DELETE CASCADE,
ADD CONSTRAINT add_relFK FOREIGN KEY (ADDRESSStreet, ADDRESSHousenumber, ADDRESSPostcode)
	REFERENCES address (Street, Housenumber, Postcode)
		ON UPDATE CASCADE
        ON DELETE CASCADE;
        
ALTER TABLE rent
ADD CONSTRAINT rentFK1 FOREIGN KEY (ORDERLINEOrderlineID) 
	REFERENCES orderline (OrderlineID) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT,
ADD CONSTRAINT rentFK2 FOREIGN KEY (ITEMSerialNumber)
	REFERENCES item (SerialNumber)
		ON UPDATE CASCADE
        ON DELETE RESTRICT;
        
ALTER TABLE role_permission
ADD CONSTRAINT rol_perFK FOREIGN KEY (ROLERole) 
	REFERENCES role (Role) 
		ON UPDATE CASCADE 
		ON DELETE CASCADE,
ADD CONSTRAINT per_rolFK FOREIGN KEY (PERMISSIONPermission)
	REFERENCES permission (Permission)
		ON UPDATE CASCADE
        ON DELETE CASCADE;
        
ALTER TABLE subscription
ADD CONSTRAINT subscriptionFK1 FOREIGN KEY (ORDERLINEOrderlineID) 
	REFERENCES orderline (OrderlineID) 
		ON UPDATE CASCADE 
		ON DELETE RESTRICT,
ADD CONSTRAINT subscriptionFK2 FOREIGN KEY (ITEMSerialNumber)
	REFERENCES item (SerialNumber)
		ON UPDATE CASCADE
        ON DELETE RESTRICT;


### END FK CONSTRAINTS ###

 

### TRIGGERS AND TABLES ESPECIALLY FOR GENERATING ALPHANUMERIC AUTO_INCREMENTAL RELATIONNUMBERS< ORDERID's AND ORDERLINEID's


## Extra table and trigger to create a sequencial alphanumberic RelationNumber
CREATE TABLE relation_seq (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

#Trigger to create unique sequencial Relationnumber
DROP TRIGGER IF EXISTS tg_relation_insert; 

DELIMITER //
CREATE TRIGGER tg_relation_insert
BEFORE INSERT ON relation
FOR EACH ROW
BEGIN
	INSERT INTO relation_seq VALUES (NULL);
	SET NEW.RelationNumber = CONCAT('REL', LPAD(LAST_INSERT_ID(), 4, '0'));
END//
DELIMITER ;

## Extra table and trigger to create a sequencial alphanumberic OrderID
CREATE TABLE order_seq (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

#Trigger to create unique sequencial Relationnumber
DROP TRIGGER IF EXISTS tg_order_insert;

DELIMITER //
CREATE TRIGGER tg_order_insert
BEFORE INSERT ON `order`
FOR EACH ROW
BEGIN
	INSERT INTO order_seq VALUES (NULL);
	SET NEW.OrderID = CONCAT('ORD', LPAD(LAST_INSERT_ID(), 6, '0'));
END// 
DELIMITER ;

## Extra table and trigger to create a sequencial alphanumberic OrderlineID
CREATE TABLE orderline_seq (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

#Trigger to create unique sequencial Relationnumber
DROP TRIGGER IF EXISTS tg_orderline_insert;

DELIMITER //
CREATE TRIGGER tg_orderline_insert
BEFORE INSERT ON orderline
FOR EACH ROW
BEGIN
	INSERT INTO order_seq VALUES (NULL);
	SET NEW.OrderlineID = CONCAT('ORDL', LPAD(LAST_INSERT_ID(), 10, '0'));
END// 
DELIMITER ;


### END ###


### STORED PROCEDURES ###
#

# Stored Procedure to create an customer account with filled-in tables: relation - account - person - address
DELIMITER //
CREATE PROCEDURE create_customer 
(IN spUsername VARCHAR(200), spPassword VARCHAR(255), spName VARCHAR(50), spLastName VARCHAR(60),
spMiddleName VARCHAR(10), spGender CHAR(1), spBirthDate DATE, spStreet VARCHAR(100),
spHousenumber VARCHAR(10), spPostcode VARCHAR(15), spProvince VARCHAR(30), spCountry VARCHAR(60),
spTypeOfAddress VARCHAR(10))
BEGIN
	INSERT INTO relation (RelationType) VALUES ('Debiteur');
	
	SET @relnum = (SELECT RelationNumber
						FROM relation					
						ORDER BY RelationNumber DESC
						LIMIT 1);
						
	SET @adPK1 = spStreet;
	SET @adPK2 = spHousenumber;
	SET @adPK3 = spPostcode;
	
	INSERT INTO account (Username, `Password`, RELATIONRelationNumber)
	VALUES (spUsername, spPassword, @relnum);
	
	INSERT INTO person (Name, LastName, MiddleName, Gender, BirthDate, RELATIONRelationNumber)
	VALUES (spName, spLastName, spMiddleName, spGender, spBirthDate, @relnum);
	
	INSERT INTO address (Street, Housenumber, Postcode, Province, Country, TypeOfAddress)
	VALUES (@adPK1, @adPK2, @adPK3, spProvince, spCountry, spTypeOfAddress);
	
	INSERT INTO relation_address VALUES (@relnum, @adPK1, @adPK2, @adPK3);
END //
DELIMITER ;

# Stored procedure to display active and/or inactive accounts
DELIMITER //
CREATE PROCEDURE sp_chart_account_status (OUT totalAccounts int, OUT totalActiveAccounts int)  
BEGIN
	SELECT count(Username) INTO totalAccounts from account;
	SELECT count(Username) INTO totalActiveAccounts from account where account.suspended = 'N';
END //
DELIMITER ;

#Stored procedure to create an accountrecord (and an attached relation record)
DELIMITER //

CREATE PROCEDURE sp_insertAccount (IN _username varchar(30), IN _password varchar(128))  
BEGIN
	INSERT INTO relation (RelationType) VALUES ('Debiteur');
	
	SET @relnum = (SELECT RelationNumber
						FROM relation					
						ORDER BY RelationNumber DESC
						LIMIT 1);

   INSERT INTO account (Username, `password`, RELATIONRelationNumber)
   VALUES (`_username`, `_password`, @relnum);

	SELECT  RELATIONRelationNumber FROM account WHERE username = `_username`;
END //

DELIMITER;

#Stored procedure to create an customeraccount (relation, account, person, address, email and phonenr)
DELIMITER //

CREATE PROCEDURE sp_insertAccount (IN _username varchar(30), IN _password varchar(128))  
BEGIN
	INSERT INTO relation (RelationType) VALUES ('Debiteur');
	
	SET @relnum = (SELECT RelationNumber
						FROM relation					
						ORDER BY RelationNumber DESC
						LIMIT 1);

   INSERT INTO account (Username, `password`, RELATIONRelationNumber)
   VALUES (`_username`, `_password`, @relnum);

	SELECT  RELATIONRelationNumber FROM account WHERE username = `_username`;
END //

DELIMITER;

DELIMITER //

CREATE PROCEDURE 
	sp_getAccountEditData (
		IN _relationNR VARCHAR(15)
	)  
BEGIN
   SELECT 
		relation.RelationNumber, 
		account.Username, account.`Password`, account.`status`, 
		address.Street, address.Housenumber, address.Postcode, address.City, address.Province, address.CountryCode, address.TypeOfAddress, 
		person.Name, person.MiddleName, person.LastName, person.Gender, person.BirthDate 
   FROM relation
	INNER JOIN account
		ON relation.RelationNumber = account.RELATIONRelationNumber
	LEFT JOIN person
		ON relation.RelationNumber = person.RELATIONRelationNumber
	LEFT JOIN relation_address
		ON relation.RelationNumber = relation_address.RELATIONRelationNumber
	LEFT JOIN address
		ON relation_address.ADDRESSStreet = address.Street
		AND relation_address.ADDRESSHousenumber = address.Housenumber
		AND relation_address.ADDRESSPostcode = address.Postcode
	LEFT JOIN email
		ON relation.RelationNumber = email.RELATIONRelationNumber
	LEFT JOIN phonenr
		ON relation.RelationNumber = phonenr.RELATIONRelationNumber
	WHERE relation.RelationNumber = 'REL0011';
END //

DELIMITER;

DELIMITER //

CREATE PROCEDURE sp_getCountries ()  
BEGIN
	SELECT * FROM country;
END //

DELIMITER ;