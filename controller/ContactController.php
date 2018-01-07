<?php

class ContactController
{
    public function create() {
        if (!isset($_POST['relationNumber']) || !isset($_POST['phoneNumber']) || !isset($_POST['emailAddress']))
            return call('Pages', 'error');
    }

    public function update() {
        if (!isset($_POST['relationNumber']) || !isset($_POST['phoneNumber']) || !isset($_POST['emailAddress']))
            return call('Pages', 'error');

        Phone::save($_POST['relationNumber'], $_POST['phoneNumber']);
        Email::save($_POST['relationNumber'], $_POST['emailAddress']);

        header('location: ?controller=Account&action=edit&relationNumber='.$_POST['relationNumber']);
        exit();
    }
}