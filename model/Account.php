<?php
class Account {
    private $accountId;
    private $username;
    private $password;

    public function __construct($accountId, $username, $password){
        $this->accountId = $accountId;
        $this->username = $username;
        $this->password = $password;
    }

    public static function all() {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM account');

        foreach($req->fetchAll() as $account) {
            $list[] = new Account($account['accountId'], $account['username'], $account['password']);
        }
        return $list;
    }

    public static function find($accountId) {
        $db = DBConnection::getInstance();
        $accountId = intval($accountId);
        $req = $db->prepare('SELECT * FROM account WHERE accountId = :accountId');
        $req->execute(array('accountId' => $accountId));
        $account = $req->fetch();
        return new Account($account['accountId'], $account['username'], $account['password']);
    }

    public static function delete($accountId) {
        $db = DBConnection::getInstance();
        $accountId = intval($accountId);
        $req = $db->prepare('DELETE FROM account WHERE accountId = :accountId');
        $req->execute(array('accountId' => $accountId));
    }

    public function getAccountId(){
        return $this->accountId;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
}