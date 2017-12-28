# Create database
CREATE DATABASE fairsoft;

USE fairsoft;

# Remove existing tables
DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS account_role;
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS company;
DROP TABLE IF EXISTS email;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS `order`;
DROP TABLE IF EXISTS orderline;
DROP TABLE IF EXISTS permission;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS phonenr;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS relation;
DROP TABLE IF EXISTS relation_address;
DROP TABLE IF EXISTS rent;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS role_permission;
DROP TABLE IF EXISTS subscription;

# Create tables
CREATE TABLE account(
	Username VARCHAR(100) UNIQUE NOT NULL,
    `Password` VARCHAR(255) NOT NULL,
    Suspended CHAR(1) DEFAULT 'N' NOT NULL,
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
    Province VARCHAR(30),
    Country VARCHAR(60) NOT NULL,
    TypeOfAddress VARCHAR(10) NOT NULL,
    
    CONSTRAINT addressPK PRIMARY KEY (Street, Housenumber, Postcode)
);

CREATE TABLE company (
	`Name` VARCHAR(60) UNIQUE NOT NULL,
    IsSupplier CHAR(1) NOT NULL,
    RELATIONRelationNumber VARCHAR(15),
    
    CONSTRAINT companyPK PRIMARY KEY (RELATIONRelationNumber)
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
	OrderID VARCHAR(15) UNIQUE NOT NULL AUTO_INCREMENT,
    OrderDate DATETIME NOT NULL,
    ACCOUNTUsername VARCHAR(100) NOT NULL,
    
    CONSTRAINT orderPK PRIMARY KEY (OrderID)
);

CREATE TABLE orderline(
	OrderlineID VARCHAR(15) UNIQUE NOT NULL AUTO_INCREMENT,
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
	RelationNumber VARCHAR(15) UNIQUE NOT NULL AUTO_INCREMENT,
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