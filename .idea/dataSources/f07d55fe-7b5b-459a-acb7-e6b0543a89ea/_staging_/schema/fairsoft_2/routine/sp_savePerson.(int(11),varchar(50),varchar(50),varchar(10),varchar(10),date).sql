DROP PROCEDURE IF EXISTS `sp_saveAddress`;
CREATE PROCEDURE sp_saveAddress(
  IN `_relationId` INT(11),
  IN `_street` VARCHAR(50),
  IN `_housenumber` INT(11),
  IN `_housenumberAddition` VARCHAR(5),
  IN `_zipcode` VARCHAR(10),
  IN `_city` VARCHAR(50),
  IN `_province` VARCHAR(50),
  IN `_country` VARCHAR(50),
  IN `_addressType` VARCHAR(30),
  IN `_validFrom` DATETIME,
  IN `_validTo` DATETIME
  )
  BEGIN
    INSERT INTO address (relationId, street, housenumber, housenumberAddition, zipcode, city, province, country, addressType, validFrom, validTo)
    VALUES(`_relationId`, `_street`, `_housenumber`, `_housenumberAddition`, `_zipcode`, `_city`, `_province`, `_country`, `_addressType`, `_validFrom`, `_validTo`)
    ON DUPLICATE KEY UPDATE
      address.relationId = `_relationId`, address.street = `_street`, address.housenumber = `_housenumber`, address.housenumberAddition = `_housenumberAddition`, address.zipcode = `_zipcode`, address.city = `_city`, address.province = `_province`, address.country = `_country`, address.addressType = `_addressType`, address.validFrom = `_validFrom`, address.validTo = `_validTo`;
  END;
