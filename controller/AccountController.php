<?php

class AccountController
{
    public function index() {
        $accounts = Account::all();
        require_once('view/account/index.php');
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

    public function show() {
        // we expect a url of form ?controller=account&action=show&id=[x]
        if (!isset($_GET['username']))
            return call('pages', 'error');

        // we use the given id to get the right account
        $account = Account::find($_GET['username']);
        require_once('view/account/show.php');
    }
}