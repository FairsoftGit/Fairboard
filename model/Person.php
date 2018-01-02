<?php

class Person
{
    private $firstname;
    private $lastname;
    private $middlename;
    private $gender;
    private $birthdate;
    private $relationId;

    public function __construct($firstname, $lastname, $middlename, $gender, $birthdate, $relationId)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->middlename = $middlename;
        $this->gender = $gender;
        $this->birthdate = $birthdate;
        $this->relationId = $relationId;
    }

    public static function save($relationId, $firstname, $lastname, $middlename, $gender, $birthdate)
    {
        $relationId = intval($relationId);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_savePerson(?,?,?,?,?,?)');
        $stmt->bindParam(1, $relationId,  PDO::PARAM_INT);
        $stmt->bindParam(2, $firstname,  PDO::PARAM_STR);
        $stmt->bindParam(3, $lastname,   PDO::PARAM_STR);
        $stmt->bindParam(4, $middlename,   PDO::PARAM_STR);
        $stmt->bindParam(5, $gender,   PDO::PARAM_STR);
        $stmt->bindParam(6, $birthdate,   PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getMiddlename()
    {
        return $this->middlename;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getRelationId()
    {
        return $this->relationId;
    }
}