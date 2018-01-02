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