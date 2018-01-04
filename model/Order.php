<?php
/**
 * Created by PhpStorm.
 * User: JustinR
 * Date: 4-1-2018
 * Time: 15:20
 */

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