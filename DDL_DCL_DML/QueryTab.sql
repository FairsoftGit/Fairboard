create procedure sp_getAccountEditData (IN `_relationId` int)  
BEGIN
   SELECT relation.RelationNumber, 
		account.*,
      address.Street, address.Housenumber, address.Postcode, address.City, address.Province, address.CountryCode, address.TypeOfAddress,
      person.Name, person.MiddleName, person.LastName, person.Gender, person.BirthDate 
   FROM relation
	LEFT JOIN account
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
	WHERE relation.RelationNumber = _relationId;
END;




#Stored procedure to create an accountrecord (and an attached relation record)

SELECT * FROM relation
LEFT JOIN account
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

CALL sp_insertCustomerAccount(
	'SightVision',
	'password',
	'Jeroen',
	'Hel',
	'van der',
	'M',
	'1983-08-10',
	'De Savornin Lohmanlaan',
	'56',
	'3354 AS',
	'Zuid-Holland',
	'NL',
	'beide',
	'jhel@avans.nl',
	'06-10232767'
);

DELIMITER //
CREATE PROCEDURE sp_insertCustomerAccount (
	IN _username VARCHAR(30), 
	IN _password VARCHAR(128),
	IN _name VARCHAR(50),
	IN _lastname VARCHAR(60),
	IN _middlename VARCHAR(10),
	IN _gender CHAR(1),
	IN _birthdate DATE,
	IN _street VARCHAR(100),
	IN _housenr VARCHAR(10),
	IN _postcode VARCHAR(15),
	IN _province VARCHAR(30),
	IN _countrycode CHAR(2),
	IN _typeofaddress VARCHAR(10),
	IN _email VARCHAR(50),
	IN _phone VARCHAR(25))
	
BEGIN
	START TRANSACTION;
	INSERT INTO relation (RelationType) VALUES ('Debiteur');
	
	SET @relnum = (SELECT RelationNumber
						FROM relation					
						ORDER BY RelationNumber DESC
						LIMIT 1);
						
	SET @street = _street;
	SET @housenr = _housenr;
	SET @postcode = _postcode;

   INSERT INTO account (Username, `password`, RELATIONRelationNumber)
   VALUES (_username, _password, @relnum);

	INSERT INTO person (Name, LastName, MiddleName, Gender, BirthDate, RELATIONRelationNumber)
	VALUES (_name, _lastname, _middlename, _gender, _birthdate, @relnum);
	
	INSERT INTO address (Street, Housenumber, Postcode, Province, CountryCode, TypeOfAddress)
	VALUES (@street, @housenr, @postcode, _province, _countrycode, _typeofaddress);
	
	INSERT INTO relation_address VALUES (@relnum, @street, @housenr, @postcode);
	
	INSERT INTO email VALUES (_email, @relnum);
	
	INSERT INTO phonenr VALUES (_phone, @relnum);
	COMMIT;
END //
DELIMITER;



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

CALL sp_insertAccount('test2', 'password');