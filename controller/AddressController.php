<?php

class AddressController
{
    public function create() {
        if (!isset($_POST['relationId']) || !isset($_POST['street']) || !isset($_POST['housenumber']) || !isset($_POST['housenumberAddition'])|| !isset($_POST['zipcode']) || !isset($_POST['addressType']))
            return call('pages', 'error');

        Address::save($_POST['relationId'], $_POST['street'], $_POST['housenumber'], $_POST['housenumberAddition'], $_POST['zipcode'], $_POST['city'], $_POST['province'], $_POST['country'], $_POST['addressType'], $_POST['validFrom'], $_POST['validTo'] );
    }

    public function update() {
        if (!isset($_POST['relationId']) || !isset($_POST['street']) || !isset($_POST['housenumber']) || !isset($_POST['housenumberAddition'])|| !isset($_POST['zipcode']) || !isset($_POST['addressType']))
            return call('pages', 'error');

        Address::save($_POST['relationId'], $_POST['street'], $_POST['housenumber'], $_POST['housenumberAddition'], $_POST['zipcode'], $_POST['city'], $_POST['province'], $_POST['country'], $_POST['addressType'], $_POST['validFrom'], $_POST['validTo'] );
        header('location: ?controller=account&action=edit&relationId='.$_POST['relationId']);
        exit();
    }
}