<?php
    include '../controllers/models-controller.php';
    include '../utils/hash.php';
    include '../utils/error-msgs.php';

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

// ADD FORM EMPTY VALIDATION

    if($_POST['add-fname'] || $_POST['add-lname'] || $_POST['add-email'] || $_POST['add-password'] || $_POST['add-role'] ) {
        if(empty($_POST['add-fname'])) {
            ErrorMsgs::msg('Ingrese nombres');
        }
    
        if(empty($_POST['add-lname'])) {
            ErrorMsgs::msg('Ingrese apellidos');
        }

        if(empty($_POST['add-email'])) {
            ErrorMsgs::msg('Ingrese correo electronico');
        }

        if(empty($_POST['add-password'])) {
            ErrorMsgs::msg('Ingrese contrasena');
        }

        if(empty($_POST['add-role'])) {
            ErrorMsgs::msg('Ingrese rol de usuario');
        }

        $firstname = validate_new_string($_POST['add-fname']);
        $lastname = validate_new_string($_POST['add-lname']);
        $username = validate_new_email($_POST['add-email']);
        $password = validate_new_string($_POST['add-password']);
        $role = $_POST['add-role'];
        
        $res = ModelDbConnection::create($firstname, $lastname, $username, $password, $role);
        if($res) {
            echo json_encode('OK');
        }
        else {
            ErrorMsgs::msg('Revisa los datos y vuelve a intentarlo');
        }
    }
    exit;
?>
