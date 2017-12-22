<?php

class AccountController
{
    public function index() {
        $accounts = Account::all();
        require_once('view/account/index.php');
    }

    public function add() {
        //header('location: ?controller=account&action=index');
        //exit();
        require_once('view/account/add.php');
    }

    public function edit() {
        if (!isset($_GET['username']))
            return call('pages', 'error');
        include_once 'model/address.php';
        $list = Account::editAccountInfo($_GET['username']);
        //header('location: ?controller=account&action=index');
        //exit();
        require_once('view/account/edit.php');
    }

    public function suspend() {
        if (!isset($_POST['username']))
            return call('pages', 'error');

        Account::suspend($_POST['username']);
       // header('location: ?controller=account&action=index');
        exit();
    }

    public function save() {
        //
        if (!isset($_POST['username']))
            return call('pages', 'error');

        Account::delete($_POST['username']);
        // header('location: ?controller=account&action=index');
        exit();
    }
}