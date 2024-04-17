<?php
    include '../controllers/models-controller.php';
    include './error-msgs.php';
    include './hash.php';

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

    if($_POST['user-update-id'] || $_POST['user-update-fname'] || $_POST['user-update-lname'] || $_POST['user-update-email'] ) {
        if(empty($_POST['user-update-fname'])) {
            ErrorMsgs::msg('Ingrese nombres');
        }
    
        if(empty($_POST['user-update-lname'])) {
            ErrorMsgs::msg('Ingrese apellidos');
        }

        if(empty($_POST['user-update-email'])) {
            ErrorMsgs::msg('Ingrese correo electronico');
        }

        $user_id = $_POST['user-update-id'];
        $user_fname = $_POST['user-update-fname'];
        $user_lname = $_POST['user-update-lname'];
        $user_email = validate_new_email($_POST['user-update-email']);

        try {
            $update = ModelDbConnection::user_update($user_id, $user_fname, $user_lname, $user_email);
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