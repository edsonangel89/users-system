<?php
    include '../controllers/models-controller.php';

    if($_GET['usid']) {
        $usid = $_GET['usid'];
        $userdel = ModelDbConnection::delete_user($usid);
        if($userdel) {
            header('Location: ../views/admin-table.php');
        }
    }
    
?>