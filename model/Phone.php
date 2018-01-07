<?php

class Phone
{
    private $phonenumber;
    private $relationNumber;

    public function __construct($phonenumber, $relationNumber)
    {
        $this->phonenumber = $phonenumber;
        $this->relationNumber = $relationNumber;
    }

    public static function save($relationNumber, $phoneNumber){
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_savePhone(?,?)');
        $stmt->bindParam(1, $relationNumber,   PDO::PARAM_STR);
        $stmt->bindParam(2, $phoneNumber,  PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}