<?php
class Orderline
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

    public static function all($relationNumber)
    {
        $orderlines = [];
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_getOrderLineHistory(?)');
        $stmt->bindParam(1, $relationNumber,  PDO::PARAM_STR);
        $stmt->execute();
        foreach ($stmt->fetchall() as $orderline) {
            $orderlines[] = new Orderline($orderline['orderDate'], $orderline['orderId'], $orderline['productName'], $orderline['serialNumber'], $orderline['salesPrice'], $orderline['RELATIONrelationNumber']);
        }

        return $orderlines;
    }

    public function getOrderDate()
    {
        $date = $this->orderDate;
        return date("d-m-Y", strtotime($date));
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

class Order
{
    private $orderDate;
    private $orderId;
    private $relationNumber;

    public function __construct($orderDate, $orderId, $relationNumber)
    {
        $this->orderDate = $orderDate;
        $this->orderId = $orderId;
        $this->relationNumber = $relationNumber;
    }

    public static function onlyOrders($relationNumber)
    {
        $orders = [];
        $db = DBConnection::getInstance();
        $stmt = $db->prepare('CALL sp_getOrderHistory(?)');
        $stmt->bindParam(1, $relationNumber,  PDO::PARAM_STR);
        $stmt->execute();
        foreach ($stmt->fetchall() as $order) {
            $orders[] = new Order($order['orderDate'], $order['orderId'], $order['RELATIONrelationNumber']);
        }

        return $orders;
    }

        public function getOrderDate()
    {
        $date = $this->orderDate;
        return date("d-m-Y", strtotime($date));
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getRelationNumber()
    {
        return $this->relationNumber;
    }
}