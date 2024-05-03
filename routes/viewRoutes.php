<?php

    require './controllers/viewsController.php';

    $views_routes = [
        '/log' => 'get_login_form',
        '/table' => 'get_table',
        '/add' => 'get_add_form',
        '/update' => 'get_update_form',
        '/notfound' => 'not_found' 
    ];

    if(array_key_exists($path, $views_routes)) {
        call_user_func($views_routes[$path]);
        exit;
    }
    else {
        call_user_func($views_routes['/notfound']);
        exit;
    }

?>