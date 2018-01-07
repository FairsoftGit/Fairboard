<?php

class Email
{
    private $emailAddress;
    private $relationNumber;

    public function __construct($emailAddress, $relationNumber)
    {
        $this->emailAddress = $emailAddress;
        $this->relationNumber = $relationNumber;
    }

    public static function save($relationNumber, $emailAddress){
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_saveEmail(?,?)');
        $stmt->bindParam(1, $relationNumber,   PDO::PARAM_STR);
        $stmt->bindParam(2, $emailAddress,  PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}