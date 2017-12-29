<?php

class PersonController
{
    public function create() {
        if (!isset($_POST['relationId']))
            return call('pages', 'error');

        Person::save($_POST['relationId'], $_POST['firstname'], $_POST['lastname'], $_POST['middlename'], $_POST['gender'], $_POST['birthdate']);
    }

    public function update() {
        if (!isset($_POST['relationId']))
            return call('pages', 'error');

        Person::save($_POST['relationId'], $_POST['firstname'], $_POST['lastname'], $_POST['middlename'], $_POST['gender'], $_POST['birthdate']);
        header('location: ?controller=account&action=edit&relationId='.$_POST['relationId']);
        exit();
    }
}