DROP  PROCEDURE  if EXISTS  sp_chart_account_status;
CREATE PROCEDURE sp_chart_account_status(
  OUT totalAccounts INT,
  OUT totalActiveAccounts INT
)
  BEGIN
    SELECT count(relationId) INTO totalAccounts from account;
    SELECT count(relationId) INTO totalActiveAccounts from account where account.status = 1;
  END;
