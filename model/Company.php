<?php

class Company
{
    private $name;
    private $isSupplier;
    private $relationNumber;

    public function __construct($name, $isSupplier, $relationNumber)
    {
        $this->name = $name;
        $this->isSupplier = $isSupplier;
        $this->relationNumber = $relationNumber;
    }

    public static function all()
    {
        $companies = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM company;');

        foreach ($req->fetchAll() as $company) {
            $companies[] = new Company($company['name'], $company['isSupplier'], $company['RELATIONrelationNumber']);
        }
        return $companies;
    }

    public static function create($productName, $productDesc, $purchasePrice, $salesPrice, $rentalPrice, $relationNumber)
    {
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_createProduct(?,?,?,?,?,?)');
        $stmt->bindParam(1, $productName,  PDO::PARAM_STR);
        $stmt->bindParam(2, $productDesc,   PDO::PARAM_STR);
        $stmt->bindParam(3, $purchasePrice,   PDO::PARAM_STR);
        $stmt->bindParam(4, $salesPrice,  PDO::PARAM_STR);
        $stmt->bindParam(5, $rentalPrice,   PDO::PARAM_STR);
        $stmt->bindParam(6, $relationNumber,   PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['productId'];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIsSupplier()
    {
        return $this->isSupplier;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}