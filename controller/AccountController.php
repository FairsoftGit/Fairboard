<?php

class AccountController
{
    public function index() {
        $accounts = Account::all();
        require_once('view/account/index.php');
    }

    public function add() {
        require_once('view/account/add.php');
    }

    public function edit(){
        require_once 'model/Person.php';
        require_once 'model/Address.php';
        require_once 'model/Country.php';
        require_once 'model/Orderline.php';

        if (!isset($_GET['relationNumber']))
            return call('pages', 'error');
        $list = Account::getAccountEditData($_GET['relationNumber']);
        $account = $list[0];
        $address = $list[1];
        $person = $list[2];

        if($account->getRelationNumber() == null){
            return call('pages', 'error');
        }
        $countryList = Country::all();
        $orderlines = Orderline::all($_GET['relationNumber']);
        require_once('view/account/edit.php');
    }

    public function update() {
        if (!isset($_POST['relationNumber']) || !isset($_POST['username']) || !isset($_POST['password']))
            return call('pages', 'error');

        Account::update($_POST['relationNumber'], $_POST['username'], $_POST['password'], (isset($_POST['status']) == true ? 1 : 0));
        header('location: ?controller=account&action=edit&relationNumber='.$_POST['relationNumber']);
        exit();
    }

    public function create() {
        if (!isset($_POST['username']) || !isset($_POST['password']))
            return call('pages', 'error');

        $relationId  = Account::create($_POST['username'], $_POST['password'], (isset($_POST['status']) == true ? 1 : 0));
        if($relationId == 0)
        {

        }
        else{
            header('location: ?controller=account&action=edit&relationNumber='.$relationId);
            exit();
        }
    }
}