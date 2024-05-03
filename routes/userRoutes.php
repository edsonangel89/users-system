<?php

    require 'controllers/usersController.php';
    require 'controllers/viewsController.php';
    
    $view_path = '/' . substr(parse_url(PATH, PHP_URL_PATH), 11);

    $user_get_routes = [
        '/' => 'get_users',
        '/logout' => 'logout',
        '/notfound' => 'not_found'
    ];

    $user_post_routes = [
        '/create' => 'add_user',
        '/login' => 'login',
        '/notfound' => 'not_found'
    ];

    $user_put_routes = [
        '/update' => 'update_user',
        '/notfound' => 'not_found'
    ];

    $user_delete_routes = [
        '/delete' => 'delete_user',
        '/notfound' => 'not_found'
    ];

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(array_key_exists($view_path, $user_get_routes) && $view_path == '/') {
            call_user_func($user_get_routes[$view_path]);
            exit;
        }
        elseif(array_key_exists($view_path, $user_get_routes) && $view_path == '/logout') {
            call_user_func($user_get_routes[$view_path]);
            exit;
        }
        elseif (array_key_exists($view_path, $user_delete_routes) && $view_path == '/delete') {
            call_user_func($user_delete_routes[$view_path], $_GET['get-user']);
            exit;
        }
        else {
            call_user_func($user_routes['/notfound']);
            exit;
        }
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(array_key_exists($view_path, $user_post_routes) && $view_path == '/create') {
            $firstname = validate_new_string($_POST['add-fname']);
            $lastname = validate_new_string($_POST['add-lname']);
            $username = validate_new_email($_POST['add-email']);
            $password = validate_new_string($_POST['add-password']);
            $role = $_POST['add-role'];

            $user_info = [
                $firstname,
                $lastname,
                $username,
                $password,
                $role
            ];
            call_user_func_array($user_post_routes[$view_path], $user_info);
            exit;
        }

        elseif (array_key_exists($view_path, $user_post_routes) && $view_path == '/login') {
            $username = validate_email($_POST['login-email']);
            $password = validate_password($_POST['login-password']);

            $user_info = [
                $username,
                $password,
            ];
            call_user_func_array($user_post_routes[$view_path], $user_info);
            exit;
        }

        elseif(array_key_exists($view_path, $user_put_routes) && $view_path == '/update') {
            $user_id = $_POST['update-id'];
            $user_fname = $_POST['update-fname'];
            $user_lname = $_POST['update-lname'];
            $user_email = validate_new_email($_POST['update-email']);
            if(empty($_POST['update-password'])) {
                $user_password = '';
            }
            else {
                $user_password = $_POST['update-password'];
            }
            if(empty($_POST['update-role'])) {
                $user_role = '';
            }
            else {
                $user_role = $_POST['update-role'];
            }

            $user_info = [
                $user_id,
                $user_fname,
                $user_lname,
                $user_email,
                $user_password,
                $user_role
            ];

            call_user_func_array($user_put_routes[$view_path], $user_info);
            exit;
        }
        else {
            call_user_func($user_post_routes['/notfound']);
            exit;
        }
    }

?>