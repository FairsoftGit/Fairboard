DROP PROCEDURE IF EXISTS `sp_getCountries`;
CREATE PROCEDURE sp_getCountries()
  BEGIN
    SELECT * FROM country;
  END;
