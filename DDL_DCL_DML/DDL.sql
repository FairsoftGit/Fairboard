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
DROP TABLE IF EXISTS relation;
DROP TABLE IF EXISTS relation_address;
DROP TABLE IF EXISTS rent;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS role_permission;
DROP TABLE IF EXISTS subscription;