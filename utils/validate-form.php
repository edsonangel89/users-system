<?php
    include '../controllers/models-controller.php';
    include '../utils/hash.php';
    include '../utils/error-msgs.php';

    //FUNCTIONS FOR DATA VALIDATION

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

    // LOGIN FORM VALIDATION

    if($_POST['login-email'] || $_POST['login-password']) {

        if(empty($_POST['login-email'])) {
            ErrorMsgs::msg('Ingrese correo electronico');
        }
    
        if(empty($_POST['login-password'])) {
            ErrorMsgs::msg('Ingrese contrasena');
        }
        
        $username = validate_email($_POST['login-email']);
        $password = validate_password($_POST['login-password']);
        
        $res = ModelDbConnection::login($username, $password);
        if($res) {
            $get_data = ModelDbConnection::get_user_email($username);
            if(verifier($get_data['Password'], $password) && $username == $get_data['Email']) {
                session_start();
                $_SESSION['user'] = $get_data['FirstName'];
                $_SESSION['email'] = $get_data['Email'];
                $_SESSION['role'] = $get_data['Role'];
                echo json_encode('OK');
            }
            else {
                ErrorMsgs::msg('Usuario y/o contrasena incorrectos');
            }    
        }
    }
    exit;
?>