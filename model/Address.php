<?php
class Address {
    private $street;
    private $housenumber;
    private $housenumberAddition;
    private $postcode;
    private $city;
    private $province;
    private $countryCode;
    private $typeOfAddress;

    public function __construct($street, $housenumber, $housenumberAddition, $postcode, $city, $province, $countryCode, $typeOfAddress ){
        $this->street = $street;
        $this->housenumber = $housenumber;
        $this->housenumberAddition = $housenumberAddition;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->province = $province;
        $this->countryCode = $countryCode;
        $this->typeOfAddress = $typeOfAddress;
    }

    public static function save($street, $housenumber, $postcode, $city, $province, $countryCode, $typeOfAddress)
    {
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

    public function getStreet(){
        return $this->street;
    }

    public function getHousenumber(){
        return $this->housenumber;
    }

    public function getHousenumberAddition(){
        return $this->housenumberAddition;
    }


    public function getPostcode(){
        return $this->postcode;
    }

    public function getCity(){
        return $this->city;
    }

    public function getProvince(){
        return $this->province;
    }

    public function getCountryCode(){
        return $this->countryCode;
    }

    public function getTypeOfAddress(){
        return $this->typeOfAddress;
    }
}