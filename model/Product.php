<?php

class Product
{
    private $productId;
    private $productName;
    private $productDesc;
    private $purchasePrice;
    private $salesPrice;
    private $rentalPrice;
    private $relationNumber;

    public function __construct($productId, $productName, $productDesc, $purchasePrice, $salesPrice, $rentalPrice, $relationNumber)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productDesc = $productDesc;
        $this->purchasePrice = $purchasePrice;
        $this->salesPrice = $salesPrice;
        $this->rentalPrice = $rentalPrice;
        $this->relationNumber = $relationNumber;
    }

    public static function all()
    {
        $products = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM product;');

        foreach ($req->fetchAll() as $product) {
            $products[] = new Product($product['productId'], $product['productName'], $product['productDesc'], $product['purchasePrice'], $product['salesPrice'], $product['rentalPrice'], $product['COMPANYRELATIONrelationNumber']);
        }
        return $products;
    }

    public static function edit($productId)
    {
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('call sp_getProductById(?)');
        $stmt->bindParam(1, $productId,  PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        $product = new Product($result['productId'], $result['productName'], $result['productDesc'], $result['purchasePrice'], $result['salesPrice'], $result['rentalPrice'], $result['COMPANYRELATIONrelationNumber']);
        return $product;
    }

    public static function create($productName, $productDesc, $purchasePrice, $salesPrice, $rentalPrice, $relationNumber)
    {
        $productId = null;
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_saveProduct(?,?,?,?,?,?,?)');
        $stmt->bindParam(1, $productId,  PDO::PARAM_STR);
        $stmt->bindParam(2, $productName,  PDO::PARAM_STR);
        $stmt->bindParam(3, $productDesc,   PDO::PARAM_STR);
        $stmt->bindParam(4, $purchasePrice,   PDO::PARAM_STR);
        $stmt->bindParam(5, $salesPrice,  PDO::PARAM_STR);
        $stmt->bindParam(6, $rentalPrice,   PDO::PARAM_STR);
        $stmt->bindParam(7, $relationNumber,   PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['productId'];
    }

    public static function update($productId, $productName, $productDesc, $purchasePrice, $salesPrice, $rentalPrice, $relationNumber)
    {
        $purchasePrice = floatval($purchasePrice);
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_saveProduct(?,?,?,?,?,?,?)');
        $stmt->bindParam(1, $productId,  PDO::PARAM_STR);
        $stmt->bindParam(2, $productName,  PDO::PARAM_STR);
        $stmt->bindParam(3, $productDesc,   PDO::PARAM_STR);
        $stmt->bindParam(4, $purchasePrice,   PDO::PARAM_STR);
        $stmt->bindParam(5, $salesPrice,  PDO::PARAM_STR);
        $stmt->bindParam(6, $rentalPrice,   PDO::PARAM_STR);
        $stmt->bindParam(7, $relationNumber,   PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['productId'];
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductDesc()
    {
        return $this->productDesc;
    }

    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }

    public function getSalesPrice()
    {
        return $this->salesPrice;
    }

    public function getRentalPrice()
    {
        return $this->rentalPrice;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}