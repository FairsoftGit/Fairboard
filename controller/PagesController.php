<?php

class PagesController
{
    public function home() {
        require_once ('model/Account.php');
        $accountStatusArray = Account::chart_account_status();
        require_once('view/pages/home.php');
    }

    public function error() {
        require_once('view/pages/error.php');
    }
}