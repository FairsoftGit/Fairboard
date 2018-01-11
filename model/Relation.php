<?php

class Relation
{
    private $relationNumber;
    private $relationType;
    private $isActive;
    private $emailAddress;
    private $phoneNumber;

    public function __construct($relationNumber, $relationType, $isActive, $emailAddress, $phoneNumber)
    {
        $this->relationNumber = $relationNumber;
        $this->relationType = $relationType;
        $this->isActive = $isActive;
        $this->emailAddress = $emailAddress;
        $this->phoneNumber = $phoneNumber;
    }

    public static function update($relationNumber, $relationType, $isActive, $emailAddress, $phoneNumber)
    {
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_saveRelation(?,?,?,?,?)');
        $stmt->bindParam(1, $relationNumber,   PDO::PARAM_STR);
        $stmt->bindParam(2, $relationType,  PDO::PARAM_STR);
        $stmt->bindParam(3, $isActive,  PDO::PARAM_INT);
        $stmt->bindParam(4, $emailAddress,   PDO::PARAM_STR);
        $stmt->bindParam(5, $phoneNumber,   PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function getAllRelationTypes(){
        $relationTypes = [];
        $db = DBConnection::getInstance();
        $stmt = $db->query('SELECT * FROM relationType');

        foreach ($stmt->fetchAll() as $type){
            $relationTypes[] = $type['type'];
        }
        return $relationTypes;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }

    public function getRelationType()
    {
        return $this->relationType;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
}