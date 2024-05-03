<?php

    /*session_start();

    if($_SESSION) {
        switch($_SESSION['role']) {
            case 'user';
                header('Location: /users/views/user-table.php');
                break;
            case 'admin':
                header('Location: /users/views/admin-table.php');    
                break;
        }
    }
    else {
        header('Location: /users/views/login.php');
    }
    
    if($_GET['logout'] == 'true') {
        session_destroy();
        header('Location: /users/views/login.php');
    }*/

    function get_login_form() {
        require 'views/login.php';
    }

    function get_add_form() {
        require 'views/add.php';
    }

    function get_update_form() {
        require 'views/update-user.php';
    }

    function get_user_update() {
        require 'views/update-user.php';
    }

    function get_admin_table() {
        require 'views/admin-table.php';
    }

    function get_table() {
        require 'views/admin-table.php';
    }

    function not_found() {
        require 'views/404.php';
    }

?>