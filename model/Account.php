<?php
class Account {
    private $username;
    private $password;
    private $suspended;

    public function __construct($username, $password, $suspended){
        $this->username = $username;
        $this->password = $password;
        $this->suspended = $suspended;
    }

    public static function all() {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM account');

        foreach($req->fetchAll() as $account) {
            $list[] = new Account($account['Username'], $account['Password'], $account['Suspended']);
        }
        return $list;
    }

    public static function find($username) {
        $db = DBConnection::getInstance();
        $req = $db->prepare('SELECT * FROM account WHERE accountId = :username');
        $req->execute(array('Username' => $username));
        $account = $req->fetch();
        return new Account($account['Username'], $account['Password']);
    }

    public static function suspend($username) {
        $db = DBConnection::getInstance();
        $req = $db->prepare("UPDATE account set Suspended = 'Y' where username = :username");
        $req->execute(array('username' => $username));
    }

    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getSuspended(){
        return $this->suspended;
    }
}