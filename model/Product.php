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
            $products[] = new Product($product['productId'], $product['productName'], $product['productDesc'], $product['purchasePrice'], $product['salesPrice'], $product['rentalPrice'], $product['relationNumber']);
        }
        return $products;
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