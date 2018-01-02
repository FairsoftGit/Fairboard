<?php

class Person
{
    private $firstName;
    private $lastName;
    private $middleName;
    private $gender;
    private $birthDate;
    private $relationNumber;

    public function __construct($firstName, $middleName, $lastName, $gender, $birthDate, $relationNumber)
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->relationNumber = $relationNumber;
    }

    public static function save($relationNumber, $firstName, $middleName, $lastName, $gender, $birthDate)
    {
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_savePerson(?,?,?,?,?,?)');
        $stmt->bindParam(1, $relationNumber,  PDO::PARAM_STR);
        $stmt->bindParam(2, $firstName,  PDO::PARAM_STR);
        $stmt->bindParam(3, $middleName,   PDO::PARAM_STR);
        $stmt->bindParam(4, $lastName,   PDO::PARAM_STR);
        $stmt->bindParam(5, $gender,   PDO::PARAM_STR);
        $stmt->bindParam(6, $birthDate,   PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}