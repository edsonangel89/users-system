<?php
    include '../controllers/models-controller.php';
    include '../utils/error-msgs.php';

    function user($user_id) {
        $id = $user_id;
        $user = ModelDbConnection::get_user($user_id);
        return $user;
    }

    function user_email($email) {
        $email = $user_email;
        $user = ModelDbConnection::get_user_email($user_email);
        return $email;
    }

    if(isset($_GET['email'])) {
        $get_user = user($_GET['email']);
        echo json_encode($get_user);
    }
?>