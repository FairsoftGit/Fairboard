<?php
class Address {
    private $street;
    private $housenumber;
    private $zipcode;
    private $city;
    private $province;
    private $country;
    private $typeOfAddress;

    public function __construct($street, $housenumber, $zipcode, $city, $province, $country, $typeOfAddress ){
        $this->street = $street;
        $this->housenumber = $housenumber;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->typeOfAddress = $typeOfAddress;
    }

    public function getStreet(){
        return $this->street;
    }
    public function getHousenumber(){
        return $this->housenumber;
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
    public function getTypeOfAddress(){
        return $this->typeOfAddress;
    }
}