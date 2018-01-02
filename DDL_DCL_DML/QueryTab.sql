DELIMITER //
CREATE PROCEDURE sp_saveAddress (
	IN _relationId VARCHAR(15)
	, IN _street VARCHAR(50)
	, IN `_housenumber` VARCHAR(10)
	, IN `_postcode` VARCHAR(15)
	, IN `_city` VARCHAR(50)
	, IN `_province` VARCHAR(30)
	, IN `_country` CHAR(2)
	, IN `_addressType` VARCHAR(10)
)  
BEGIN	
	INSERT INTO address (
		street
		, housenumber
		, postcode
		, city
		, province
		, countrycode
		, typeofaddress
	)
   VALUES(
		_street
		, _housenumber
		, _postcode
		, _city
		, _province
		, _country
		, _addressType
	)
   ON DUPLICATE KEY UPDATE
		address.street = _street
		, address.housenumber = _housenumber
		, address.postcode = _postcode
		, address.city = _city
		, address.province = _province
		, address.`country` = _country
		, address.typeofaddress = _addressType;
		
	INSERT INTO relation_address (
		RELATIONRelationNumber
		, ADDRESSstreet
		, ADDRESShousenumber
		, ADDRESSpostcode
	)
   VALUES(
		_relationId
		, _street
		, _housenumber
		, _postcode
	)
   ON DUPLICATE KEY UPDATE
		relation_address.RELATIONRelationNumber = _relationId
		, relation_address.ADDRESSStreet = _street
		, relation_address.ADDRESShousenumber = _housenumber
		, relation_address.ADDRESSpostcode = _postcode;
  END;