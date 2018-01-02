<?php
function call($controller, $action) {
    require_once('controller/' . $controller . 'controller.php');

    switch($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'account':
            require_once('model/Account.php');
            $controller = new AccountController();
            break;
        case 'person':
            require_once('model/Person.php');
            $controller = new PersonController();
            break;
        case 'address':
            require_once('model/Address.php');
            $controller = new AddressController();
            break;
        case 'product':
            require_once ('model/Product.php');
            $controller = new ProductController();
            break;

    }
    $controller->{ $action }();
}

// Add available actions for the controller
$controllers = array('pages' => ['home', 'error'],
                    'account' => ['index', 'add', 'edit', 'create', 'update'],
                    'person' => ['create', 'update'],
                    'address' => ['create', 'update'],
                    'product' => ['index', 'add', 'create', 'update', 'delete'],);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}
?>