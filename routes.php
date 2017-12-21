<?php
function call($controller, $action) {
    require_once('controller/' . $controller . 'controller.php');

    switch($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'account':
            // we need the model to query the database later in the controller
            require_once('model/Account.php');
            $controller = new AccountController();
            break;
    }
    $controller->{ $action }();
}

// we're adding an entry for the new controller and its actions
$controllers = array('pages' => ['home', 'error'],
                    'account' => ['index', 'show', 'deleteAccount']);

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