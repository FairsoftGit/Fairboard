<?php
class Address {
    private $street;
    private $housenumber;
    private $postcode;
    private $city;
    private $province;
    private $countryCode;
    private $typeOfAddress;

    public function __construct($street, $housenumber, $postcode, $city, $province, $countryCode, $typeOfAddress ){
        $this->street = $street;
        $this->housenumber = $housenumber;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->province = $province;
        $this->countryCode = $countryCode;
        $this->typeOfAddress = $typeOfAddress;
    }

    public static function save($street, $housenumber, $postcode, $city, $province, $countryCode, $typeOfAddress)
    {
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_saveAddress(?,?,?,?,?,?,?,?)');
        $stmt->bindParam(1, $relationId,  PDO::PARAM_INT);
        $stmt->bindParam(2, $street,  PDO::PARAM_STR);
        $stmt->bindParam(3, $housenumber,   PDO::PARAM_STR);
        $stmt->bindParam(4, $postcode,   PDO::PARAM_STR);
        $stmt->bindParam(5, $city,   PDO::PARAM_STR);
        $stmt->bindParam(6, $province,   PDO::PARAM_STR);
        $stmt->bindParam(7, $countryCode,   PDO::PARAM_STR);
        $stmt->bindParam(8, $typeOfAddress,   PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getStreet(){
        return $this->street;
    }

    public function getHousenumber(){
        return $this->housenumber;
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