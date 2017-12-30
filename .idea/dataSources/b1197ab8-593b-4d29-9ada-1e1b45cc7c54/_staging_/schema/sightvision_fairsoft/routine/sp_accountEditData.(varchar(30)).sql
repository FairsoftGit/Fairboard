DROP PROCEDURE IF EXISTS `sp_getAccountEditData`;
DELIMITER //
CREATE PROCEDURE sp_getAccountEditData(IN _relationId int(11))
	BEGIN
		SELECT * from fairsoft_2.account
			LEFT JOIN fairsoft_2.address
				ON fairsoft_2.account.relationId = fairsoft_2.address.relationId
			LEFT JOIN fairsoft_2.person
				ON fairsoft_2.account.relationId = fairsoft_2.person.relationId;
	END //
DELIMITER ;
