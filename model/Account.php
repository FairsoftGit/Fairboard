<?php

class Account
{
    private $username;
    private $password;
    private $status;
    private $relationId;

    public function __construct($username, $password, $status, $relationId)
    {
        $this->username = $username;
        $this->password = $password;
        $this->status = $status;
        $this->relationId = $relationId;
    }

    public static function chart_account_status()
    {
        $resultArray = [];
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_chart_account_status(@totalAccounts, @totalActiveAccounts)');
        $stmt->execute();
        $result = $db->query("SELECT @totalAccounts, @totalActiveAccounts")
            ->fetch(PDO::FETCH_ASSOC);
        $resultArray[] = $result['@totalAccounts'];
        $resultArray[] = $result['@totalActiveAccounts'];
        return $resultArray;
    }

    public static function all()
    {
        $accounts = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM account ORDER BY username');

        foreach ($req->fetchAll() as $account) {
            $accounts[] = new Account($account['Username'], $account['Password'], $account['status'], $account['RELATIONRelationNumber']);
        }
        return $accounts;
    }

    public static function getAccountEditData($relationId)
    {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->prepare('CALL sp_getAccountEditData(:relationId)');
        $req->execute(array('relationId' => $relationId));
        $result = $req->fetch();
        $account = new Account($result['Username'], $result['Password'], $result['status'], $result['RelationNumber']);
        $address = new Address($result['RelationNumber'], $result['Street'], $result['Housenumber'], $result['Postcode'], $result['City'], $result['Province'], $result['CountryCode'], $result['TypeOfAddress'] );
        $person = new Person($result['Name'], $result['LastName'], $result['MiddleName'], $result['Gender'], $result['BirthDate'], $result['RelationNumber']);
        $list[] = $account;
        $list[] = $address;
        $list[] = $person;
        return $list;

    }

    public static function create($username, $password, $status)
    {
        $status = intval($status);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_insertAccount(?,?,?)');
        $stmt->bindParam(1, $username,  PDO::PARAM_STR);
        $stmt->bindParam(2, $password,   PDO::PARAM_STR);
        $stmt->bindParam(3, $status,   PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['relationId'];
    }

    public static function update($relationId, $username, $password, $status)
    {
        $relationId = intval($relationId);
        $status = intval($status);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_updateAccount(?,?,?,?)');
        $stmt->bindParam(1, $relationId,  PDO::PARAM_INT);
        $stmt->bindParam(2, $username,  PDO::PARAM_STR);
        $stmt->bindParam(3, $password,   PDO::PARAM_STR);
        $stmt->bindParam(4, $status,   PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function submitEditData($accountForUpdate, $addressForUpdate, $personForUpdate)
    {
        $db = DBConnection::getInstance();
        $req = $db->prepare('CALL sp_submitEditData(
        :relationId,
        :username,
        :password,
        :status,
        :street,
        :housenumber,
        :housenumberAddition,
        :zipcode,
        :city,
        :province,
        :country,
        :addressType,
        :firstname,
        :lastname,
        :middlename,
        :gender,
        :birthdate
        )');
        $req->execute(array(
            'relationId' => $accountForUpdate->getRelationId(),
            'username' => $accountForUpdate->getUsername(),
            'password' => $accountForUpdate->getPassword(),
            'status' => $accountForUpdate->getStatus(),
            'street' => $addressForUpdate->getStreet(),
            'housenumber' => $addressForUpdate->getHousenumber(),
            'housenumberAddition' => $addressForUpdate->getHousenumberAddition(),
            'zipcode' => $addressForUpdate->getZipcode(),
            'city' => $addressForUpdate->getHousenumber(),
            'province' => $addressForUpdate->getProvince(),
            'country' => $addressForUpdate->getCountry(),
            'addressType' => $addressForUpdate->getAddressType(),
            'firstname' => $personForUpdate->getFirstname(),
            'lastname' => $personForUpdate->getLastname(),
            'middlename' => $personForUpdate->getMiddlename(),
            'gender' => $personForUpdate->getGender(),
            'birthdate' => $personForUpdate->getBirthdate(),
        ));
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRelationId()
    {
        return $this->relationId;
    }
}