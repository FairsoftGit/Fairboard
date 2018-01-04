<?php
function call($controller, $action) {
    $realpath = realpath ($_SERVER['DOCUMENT_ROOT'].'/fairboard/controller/' . $controller . 'Controller.php');
    $realpath = str_replace ("//", "/", $realpath);
    require_once $realpath;

    switch($controller) {
        case 'Pages':
            $controller = new PagesController();
            break;
        case 'Account':
            require_once('model/Account.php');
            $controller = new AccountController();
            break;
        case 'Person':
            require_once('model/Person.php');
            $controller = new PersonController();
            break;
        case 'Address':
            require_once('model/Address.php');
            $controller = new AddressController();
            break;
        case 'Product':
            require_once ('model/Product.php');
            $controller = new ProductController();
            break;
        case 'Orderline':
            require_once ('model/Orderline.php');
            $controller = new OrderlineController();
            break;
        case 'Order':
            require_once ('model/Orderline.php');
            $controller = new OrderlineController();
            break;

    }
    $controller->{ $action }();
}

// Add available actions for the controller
$controllers = array('Pages' => ['home', 'error'],
                    'Account' => ['index', 'add', 'edit', 'create', 'update', 'toggleStatus'],
                    'Person' => ['create', 'update'],
                    'Address' => ['create', 'update'],
                    'Product' => ['index', 'add', 'create', 'update', 'delete'],
                    'Orderline' => ['index']);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('Pages', 'error');
    }
} else {
    call('Pages', 'error');
}
?>