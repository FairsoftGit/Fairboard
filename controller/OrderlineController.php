<?php

class OrderlineController
{
    public function index() {
        $orderlines = Orderline::all();
        $orders = Order::onlyOrders();
        require_once('view/account/edit.php');
    }
}