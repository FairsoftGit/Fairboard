<?php

class OrderlineController
{
    public function index() {
        $orderlines = Orderline::all();
        require_once('view/account/edit.php');
    }
}