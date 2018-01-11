<?php

class RelationController
{
    public function update() {
        if (!isset($_POST['relationNumber']) || !isset($_POST['relationType']) || !isset($_POST['emailAddress']) || !isset($_POST['phoneNumber']))
            return call('Pages', 'error');

        Relation::update($_POST['relationNumber'], $_POST['relationType'], (isset($_POST['isActive']) == true ? 1 : 0), $_POST['emailAddress'], $_POST['phoneNumber']);
        header('location: ?controller=Account&action=edit&relationNumber='.$_POST['relationNumber']);
        exit();
    }
}