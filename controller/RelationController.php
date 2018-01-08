<?php

class RelationController
{
    public function save() {
        if (!isset($_POST['relationNumber']) || !isset($_POST['relationType']) || !isset($_POST['isActive']) || !isset($_POST['emailAddress']) || !isset($_POST['phoneNumber']))
            return call('Pages', 'error');

        Relation::save($_POST['relationNumber'], $_POST['relationType'], $_POST['isActive'], $_POST['emailAddress'], $_POST['phoneNumber']);
        header('location: ?controller=Account&action=edit&relationNumber='.$_POST['relationNumber']);
        exit();
    }
}