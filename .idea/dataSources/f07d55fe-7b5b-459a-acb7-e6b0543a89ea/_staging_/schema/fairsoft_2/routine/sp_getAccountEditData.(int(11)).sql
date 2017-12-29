DROP PROCEDURE IF EXISTS `sp_getAccountEditData`;
CREATE PROCEDURE sp_getAccountEditData(IN `_relationId` INT)
  BEGIN
    SELECT account.*,
      address.street, address.housenumber, address.housenumberAddition, address.zipcode, address.city, address.province, address.country, address.addressType, address.validFrom, address.validTo,
      person.firstname, person.middlename, person.lastname, person.gender, person.birthdate 
    from account
      LEFT JOIN address
        ON account.relationId = fairsoft_2.address.relationId
      LEFT JOIN fairsoft_2.person
        ON fairsoft_2.account.relationId = fairsoft_2.person.relationId
    where account.relationId = _relationId;
  END;
