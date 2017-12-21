<?php

class RoleController
{
    public function index() {
        $roles = Role::all();
        require_once('view/role/index.php');
    }
}