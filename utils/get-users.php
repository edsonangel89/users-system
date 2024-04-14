<?php
    include '../controllers/models-controller.php';
    include '../utils/error-msgs.php';

    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $users = ModelDbConnection::get_users();
        if($users) {
            echo json_encode($users);
        }
        else {
            ErrorMsgs::msg('Error al cargar usuarios, revise su conexion a intenet');
        }
    }
?>