<?php
    include '../controllers/models-controller.php';
    include './error-msgs.php';
    include './hash.php';

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
            ErrorMsgs::msg('Valor invalido, debe contener letras y numeros');
            exit;
        }
    }

    // ADMIN UPDATE FORM VALIDATION

    if($_POST['admin-update-id'] || $_POST['admin-update-fname'] || $_POST['admin-update-lname'] || $_POST['admin-update-email'] || $_POST['admin-update-password'] || $_POST['admin-update-role'] ) {
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
            $password = '';
        }
        else {
            $password = $_POST['admin-update-password'];
        }

        if(empty($_POST['admin-update-role'])) {
            ErrorMsgs::msg('Ingrese rol de usuario');
        }

        $user_id = $_POST['admin-update-id'];
        $user_fname = $_POST['admin-update-fname'];
        $user_lname = $_POST['admin-update-lname'];
        $user_email = validate_new_email($_POST['admin-update-email']);
        $user_password = $password;
        $user_role = $_POST['admin-update-role'];

        try {
            $update = ModelDbConnection::admin_update($user_id, $user_fname, $user_lname, $user_email, $user_password, $user_role);
            if($update) {
                echo json_encode('OK');
            }
            else {
                ErrorMsgs::msg('Error al actualizar usuario, verifique los datos y vuelva a intentar');    
            }
        }
        catch(mysqli_sql_exception $e) {
            ErrorMsgs::msg('Error al actualizar usuario, verifique los datos y vuelva a intentar');
        }
    }
    exit;
?>