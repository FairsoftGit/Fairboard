<?php
require_once('DBConnection.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'Pages';
    $action     = 'home';
}
require_once('view/layout.php');