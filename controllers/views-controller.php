<?php

    session_start();

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
    }

?>