<?php

class AddressController
{
    public function create() {
        if (!isset($_POST['relationNumber']) || !isset($_POST['street']) || !isset($_POST['housenumber']) || !isset($_POST['postcode']) || !isset($_POST['typeOfAddress']))
            return call('pages', 'error');

        Address::save($_POST['relationNumber'], $_POST['street'], $_POST['housenumber'], $_POST['postcode'], $_POST['city'], $_POST['province'], $_POST['countryCode'], $_POST['typeOfAddress'] );
    }

    public function update() {
        if (!isset($_POST['relationNumber']) || !isset($_POST['street']) || !isset($_POST['housenumber']) || !isset($_POST['postcode']) || !isset($_POST['typeOfAddress']))
            return call('pages', 'error');

        Address::save($_POST['relationNumber'], $_POST['street'], $_POST['housenumber'], $_POST['postcode'], $_POST['city'], $_POST['province'], $_POST['countryCode'], $_POST['typeOfAddress']);
        header('location: ?controller=account&action=edit&relationNumber='.$_POST['relationNumber']);
        exit();
    }
}