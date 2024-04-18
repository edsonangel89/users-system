<?php
    require '../models/users-model.php';

    if($_GET['usid']) {
        $usid = $_GET['usid'];
        $userdel = ModelDbConnection::delete_user($usid);
        if($userdel) {
            header('Location: ../views/admin-table.php');
        }
    }
    
?>