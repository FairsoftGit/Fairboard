DROP PROCEDURE IF EXISTS sp_insertAccount;
CREATE PROCEDURE sp_insertAccount(IN `_username` VARCHAR(30), IN `_password` VARCHAR(128), IN `_status` INT)
  BEGIN
    INSERT INTO account (username, password, status)
      VALUES (`_username`, `_password`, `_status`);

    SELECT  relationId FROM account WHERE username = `_username`;
  END;
