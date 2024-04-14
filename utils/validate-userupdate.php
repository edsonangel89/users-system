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

    // USER UPDATE FORM EMPTY VALIDATION

    elseif($_POST['user-update-fname'] || $_POST['user-update-lname'] || $_POST['user-update-email'] ) {
        if(empty($_POST['user-update-fname'])) {
            ErrorMsgs::msg('Ingrese nombres');
        }
    
        if(empty($_POST['user-update-lname'])) {
            ErrorMsgs::msg('Ingrese apellidos');
        }

        if(empty($_POST['user-update-email'])) {
            ErrorMsgs::msg('Ingrese correo electronico');
        }
    
    }
    exit;
?>