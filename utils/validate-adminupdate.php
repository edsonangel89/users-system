<?php
    function validate_new_email($email) {
        $email = trim($email);
        $email = stripcslashes($email);
        $email = htmlspecialchars($email);
        if(preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/', $email)) {
            return $email;
        }
        else {
            ErrorMsgs::msg('Correo electronico invalido');
            exit;
        }
    }

    function validate_new_string($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if(preg_match_all('/[a-zA-Z0-9]/', $data)) {
            return $data;
        }
        else {
            ErrorMsgs::msg('Contrasena Invalida');
            exit;
        }
    }

    // ADMIN UPDATE FORM EMPTY VALIDATION

    elseif($_POST['admin-update-fname'] || $_POST['admin-update-lname'] || $_POST['admin-update-email'] || $_POST['admin-update-password'] || $_POST['admin-update-role'] ) {
        if(empty($_POST['admin-update-fname'])) {
            ErrorMsgs::msg('Ingrese nombres');
        }
    
        if(empty($_POST['admin-update-lname'])) {
            ErrorMsgs::msg('Ingrese apellidos');
        }

        if(empty($_POST['admin-update-email'])) {
            ErrorMsgs::msg('Ingrese correo electronico');
        }

        if(empty($_POST['admin-update-password'])) {
            ErrorMsgs::msg('Ingrese contrasena');
        }

        if(empty($_POST['role'])) {
            ErrorMsgs::msg('Ingrese rol de usuario');
        }
    
    }
    exit;
?>