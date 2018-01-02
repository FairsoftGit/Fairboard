<?php

class PersonController
{
    public function create() {
        if (!isset($_POST['relationNumber']))
            return call('pages', 'error');

        Person::save($_POST['relationNumber'], $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['gender'], $_POST['birthDate']);
    }

    public function update() {
        if (!isset($_POST['relationNumber']))
            return call('pages', 'error');

        Person::save($_POST['relationNumber'], $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['gender'], $_POST['birthDate']);
        header('location: ?controller=account&action=edit&relationNumber='.$_POST['relationNumber']);
        exit();
    }
}