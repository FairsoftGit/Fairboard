<?php

class OrderController
{
    public function index() {
        $orderlines = Order::all();
        require_once('view/account/edit.php');
    }
}