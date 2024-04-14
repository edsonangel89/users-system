<?php
    include '../controllers/models-controller.php'

    if($_GET['email']) {
        $email = $_GET['email'];
        $userdel = ModelDbConnection::delete($email);
        if($userdel) {
            echo json_encode('OK');
        }
    }
    
?>