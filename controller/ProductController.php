<?php

class ProductController
{
    public function index() {
        if (!isset($_POST['']))
            return call('pages', 'error');
        $products = Product::all();
        require_once('view/product/index.php');
    }

    public function create() {
        require_once('view/product/create.php');
    }

    public function update(){
    }

    public function delete(){
    }
}