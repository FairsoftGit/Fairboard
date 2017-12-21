<?php
class Account {
    private $username;
    private $password;

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

    public static function all() {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM account');

        foreach($req->fetchAll() as $account) {
            $list[] = new Account($account['Username'], $account['Password']);
        }
        return $list;
    }

    public static function find($username) {
        $db = DBConnection::getInstance();
        $req = $db->prepare('SELECT * FROM account WHERE accountId = :username');
        $req->execute(array('username' => $username));
        $account = $req->fetch();
        return new Account($account['username'], $account['password']);
    }

    public static function delete($username) {
        $db = DBConnection::getInstance();
        $username = intval($username);
        $req = $db->prepare('DELETE FROM account WHERE $username = :username');
        $req->execute(array('username' => $username));
    }

    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
}