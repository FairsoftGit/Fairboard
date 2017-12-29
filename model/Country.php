<?php

class Country
{
    private $code;
    private $name_dutch;

    public function __construct($code, $name_dutch)
    {
        $this->code = $code;
        $this->name_dutch = $name_dutch;
    }

    public static function all()
    {
        $countryList = [];
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_getCountries()');
        $stmt->execute();
        foreach ($stmt->fetchAll() as $country){
            $countryList[] = new Country($country['code'], $country['name_dutch']);
        }
       return $countryList;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getName_dutch()
    {
        return $this->name_dutch;
    }
}