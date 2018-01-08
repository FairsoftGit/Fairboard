<?php

class Session
{
    private $username;
    private $password;
    private $session;

    public function __construct($username, $password, $session)
    {
        $this->username = $username;
        $this->password = $password;
        $this->session = $session;
    }

    public static function login($username, $password){
        $username = stripslashes($username);
        $password = stripslashes($password);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_login(?,?)');
        $stmt->bindParam(1, $username,  PDO::PARAM_STR);
        $stmt->bindParam(2, $password,  PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result){
            return 0;
        }
        return 1;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function getSession()
    {
        return $this->session;
    }
}
