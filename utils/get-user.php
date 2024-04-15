<?php
    include '../controllers/models-controller.php';
    //include '../utils/get-users.php';
    include '../utils/error-msgs.php';

    function user($user_email) {
        $email = $user_email;
        $user = ModelDbConnection::get_user($user_email);
        return $user;
    }
        /*}
        else {
            ErrorMsgs::msg('Error de usuario');
        }*/
?>