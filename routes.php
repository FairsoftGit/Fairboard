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
        case 'role':
            require_once('model/Role.php');
            $controller = new RoleController();
            break;
    }
    $controller->{ $action }();
}

// we're adding an entry for the new controller and its actions
$controllers = array('pages' => ['home', 'error'],
                    'account' => ['index', 'suspend'],
                    'role' => ['index']);

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