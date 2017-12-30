<?php
class Address {
    private $relationId;
    private $street;
    private $housenumber;
    private $housenumberAddition;
    private $zipcode;
    private $city;
    private $province;
    private $country;
    private $addressType;
    private $validFrom;
    private $validTo;

    public function __construct($relationId, $street, $housenumber, $housenumberAddition, $zipcode, $city, $province, $country, $addressType, $validFrom, $validTo ){
        $this->relationId = $relationId;
        $this->street = $street;
        $this->housenumber = $housenumber;
        $this->housenumberAddition = $housenumberAddition;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->addressType = $addressType;
        $this->validFrom = $validFrom;
        $this->validTo = $validTo;
    }

    public static function save($relationId, $street, $housenumber, $housenumberAddition, $zipcode, $city, $province, $country, $addressType, $validFrom, $validTo)
    {
        $relationId = intval($relationId);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_saveAddress(?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bindParam(1, $relationId,  PDO::PARAM_INT);
        $stmt->bindParam(2, $street,  PDO::PARAM_STR);
        $stmt->bindParam(3, $housenumber,   PDO::PARAM_INT);
        $stmt->bindParam(4, $housenumberAddition,   PDO::PARAM_STR);
        $stmt->bindParam(5, $zipcode,   PDO::PARAM_STR);
        $stmt->bindParam(6, $city,   PDO::PARAM_STR);
        $stmt->bindParam(7, $province,   PDO::PARAM_STR);
        $stmt->bindParam(8, $country,   PDO::PARAM_STR);
        $stmt->bindParam(9, $addressType,   PDO::PARAM_STR);
        $stmt->bindParam(10, $validFrom,   PDO::PARAM_STR);
        $stmt->bindParam(11, $validTo,   PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getRelationId(){
        return $this->relationId;
    }

    public function getStreet(){
        return $this->street;
    }

    public function getHousenumber(){
        return $this->housenumber;
    }

    public function getHousenumberAddition(){
        return $this->housenumberAddition;
    }

    public function getZipcode(){
        return $this->zipcode;
    }

    public function getCity(){
        return $this->city;
    }

    public function getProvince(){
        return $this->province;
    }

    public function getCountry(){
        return $this->country;
    }

    public function getAddressType(){
        return $this->addressType;
    }

    public function getValidFrom(){
        return $this->validFrom;
    }

    public function getValidTo(){
        return $this->validTo;
    }
}