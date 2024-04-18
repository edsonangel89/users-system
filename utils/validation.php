<?php
    function validate_email($email) {
        $email = trim($email);
        $email = stripcslashes($email);
        $email = htmlspecialchars($email);
        return $email;
    }

    function validate_password($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validate_new_email($email) {
        $email = trim($email);
        $email = stripcslashes($email);
        $email = htmlspecialchars($email);
        $email = strtolower($email);
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
?>