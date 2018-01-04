<?php

class ProductController
{
    public function index() {
        $products = Product::all();
        require_once('view/product/index.php');
    }

    public function add() {
        require_once('model/Company.php');
        $companies = Company::all();
        require_once('view/product/add.php');
    }

    public function create() {
        if (!isset($_POST['productName']) || !isset($_POST['relationNumber']))
            return call('Pages', 'error');
        $productId = Product::create($_POST['productName'], $_POST['productDesc'], $_POST['purchasePrice'], $_POST['salesPrice'], $_POST['rentalPrice'], $_POST['relationNumber']);
        header('location: ?controller=Product&action=index');
        exit();
    }

    public function update(){
    }

    public function delete(){
    }
}