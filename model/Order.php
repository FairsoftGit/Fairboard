<?php

class Order
{
    private $orderDate;
    private $orderId;
    private $productName;
    private $serialNumber;
    private $salesPrice;
    private $relationNumber;

    public function __construct($orderDate, $orderId, $productName, $serialNumber, $salesPrice, $relationNumber)
    {
        $this->orderDate = $orderDate;
        $this->orderId = $orderId;
        $this->productName = $productName;
        $this->serialNumber = $serialNumber;
        $this->salesPrice = $salesPrice;
        $this->relationNumber = $relationNumber;
    }

    public static function all()
    {
        $orderlines = [];
        $db = DBConnection::getInstance();
        $req = $db->query('CALL sp_getOrderHistory(?)');

        foreach ($req->fetchall() as $orderline) {
            $orderlines[] = new Orderline($orderline['orderDate'], $orderline['orderId'], $orderline['productName'], $orderline['serialNumber'], $orderline['salesPrice'], $orderline['RELATIONrelationNumber']);
        }
        return $orderlines;
    }

    public function getOrderDate()
    {
        return $this->orderDate;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    public function getSalesPrice()
    {
        return $this->salesPrice;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}