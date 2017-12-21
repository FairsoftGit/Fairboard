<?php

class AccountController
{
    public function index() {
        $accounts = Account::all();
        require_once('view/account/index.php');
    }

    public function delete() {
        if (!isset($_POST['accountId']))
            return call('pages', 'error');

        Account::delete($_POST['accountId']);
       // header('location: ?controller=account&action=index');
        exit();
    }

    public function save() {
        //
        if (!isset($_POST['accountId']))
            return call('pages', 'error');

        Account::delete($_POST['accountId']);
        // header('location: ?controller=account&action=index');
        exit();
    }

    public function show() {
        // we expect a url of form ?controller=account&action=show&id=[x]
        if (!isset($_GET['accountId']))
            return call('pages', 'error');

        // we use the given id to get the right account
        $account = Account::find($_GET['accountId']);
        require_once('view/account/show.php');
    }
}