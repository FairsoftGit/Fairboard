<?php

class AccountRole
{
    private $accountId;
    private $roleId;

    public function __construct($accountId, $roleId){
        $this->accountId = $accountId;
        $this->roleId = $roleId;
    }

    public static function all() {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM account_role');

        foreach($req->fetchAll() as $account_role) {
            $list[] = new Account($account_role['accountId'], $account_role['roleId']);
        }
        return $list;
    }

    public static function find($accountId, $roleId) {
        $db = DBConnection::getInstance();
        $accountId = intval($accountId);
        $roleId = intval($roleId);
        $req = $db->prepare('SELECT * FROM account_role WHERE accountId = :accountId AND roleId = :roleId');
        $req->execute(array('accountId' => $accountId, 'roleId' => $roleId));
        $account_role = $req->fetch();

        return new AccountRole($account_role['accountId'], $account_role['roleId']);
    }

    public static function delete($accountId, $roleId) {
        $db = Db::getInstance();
        $accountId = intval($accountId);
        $roleId = intval($roleId);
        $req = $db->prepare('DELETE FROM account_role WHERE accountId = :accountId AND roleId = :roleId');
        $req->execute(array('accountId' => $accountId, 'roleId' => $roleId));
    }

    public function getAccountId(){
        return $this->accountId;
    }

    public function getRoleId(){
        return $this->roleId;
    }
}