drop PROCEDURE  IF EXISTS sp_saveAccount;
CREATE PROCEDURE sp_updateAccount(IN `_relationId` INT, IN `_username` VARCHAR(30), IN `_password` VARCHAR(128),
                                IN `_status`     INT)
  BEGIN
    UPDATE account
    SET account.password = _password, account.status = _status
    WHERE account.username = _username
    AND account.relationId = _relationId;
  END;
