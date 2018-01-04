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

    public function edit() {
        require_once('model/Company.php');
        if(!isset($_GET['productId'])){
            return call('Pages', 'error');
        }
        $companies = Company::all();
        $product = Product::edit($_GET['productId']);
        require_once('view/product/edit.php');
    }

    public function create() {
        if (!isset($_POST['productName']) || !isset($_POST['relationNumber']))
            return call('Pages', 'error');
        $productId = Product::create($_POST['productName'], $_POST['productDesc'], $_POST['purchasePrice'], $_POST['salesPrice'], $_POST['rentalPrice'], $_POST['relationNumber']);
        if($productId != 0){
            header('location: ?controller=Product&action=edit&productId='.$productId);
            exit();
        }
        #return call('Pages', 'error');
    }

    public function update(){
        if (!isset($_POST['productId']) || !isset($_POST['productName']) || !isset($_POST['relationNumber'])){
            return call('Pages', 'error');
        }
        $productId = Product::update($_POST['productId'], $_POST['productName'], $_POST['productDesc'], $_POST['purchasePrice'], $_POST['salesPrice'], $_POST['rentalPrice'], $_POST['relationNumber']);
        if($productId != 0){
            header('location: ?controller=Product&action=edit&productId='.$productId);
            exit();
        }
        return call('Pages', 'error');
    }

    public function delete(){
    }
}