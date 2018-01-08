<?php

class Account
{
    private $username;
    private $password;
    private $status;
    private $relationNumber;

    public function __construct($username, $password, $status, $relationNumber)
    {
        $this->username = $username;
        $this->password = $password;
        $this->status = $status;
        $this->relationNumber = $relationNumber;
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
            $accounts[] = new Account($account['username'], $account['password'], $account['status'], $account['RELATIONrelationNumber']);
        }
        return $accounts;
    }

    public static function getAccountEditData($relationNumber)
    {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->prepare('CALL sp_getAccountEditData(:relationNumber)');
        $req->execute(array('relationNumber' => $relationNumber));
        $result = $req->fetch();
        $account = new Account($result['username'], $result['password'], $result['status'], $result['relationNumber']);
        $address = new Address($result['street'], $result['housenumber'],  $result['postcode'], $result['city'], $result['province'], $result['countryCode'], $result['typeOfAddress'] );
        $person = new Person($result['firstName'], $result['lastName'], $result['middleName'], $result['gender'], $result['birthDate'], $result['relationNumber']);
        $relation = new Relation($result['relationNumber'], $result['relationType'], $result['isActive'], $result['emailAddress'], $result['phoneNumber']);
        $list[] = $account;
        $list[] = $address;
        $list[] = $person;
        $list[] = $relation;
        return $list;

    }

    public static function create($username, $password, $status)
    {
        try {
            $status = intval($status);
            $db = DBConnection::getInstance();
            $stmt = $db->prepare('CALL sp_createAccount(?,?,?)');
            $stmt->bindParam(1, $username,  PDO::PARAM_STR);
            $stmt->bindParam(2, $password,   PDO::PARAM_STR);
            $stmt->bindParam(3, $status,   PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['RELATIONrelationNumber'];
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                // duplicate entry, do something else
                return 0;
            } else {
                // an error other than duplicate entry occurred
            }
        }
    }

    public static function toggleStatus($username, $status){
        $status = intval($status);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_toggleStatus(?,?)');
        $stmt->bindParam(1, $username,  PDO::PARAM_STR);
        $stmt->bindParam(2, $status,  PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function update($relationNumber, $username, $password, $status)
    {
        $status = intval($status);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_updateAccount(?,?,?,?)');
        $stmt->bindParam(1, $relationNumber,  PDO::PARAM_INT);
        $stmt->bindParam(2, $username,  PDO::PARAM_STR);
        $stmt->bindParam(3, $password,   PDO::PARAM_STR);
        $stmt->bindParam(4, $status,   PDO::PARAM_INT);
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

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}