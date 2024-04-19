<?php
    require '../models/users-model.php';
    require '../utils/validation.php';
    require '../utils/hash.php';
    require '../utils/error-msgs.php';

    //////////////////////////////////// LOGIN CONTROLLER ///////////////////////////////////////////////

    if(isset($_POST['login-email']) && isset($_POST['login-password'])) {

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
                $_SESSION['id'] = $get_data['UserID'];
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

    /////////////////////////// ADD NEW USER CONTROLLER ///////////////////////////////////////////////

    if (isset($_POST['add-fname']) || isset($_POST['add-lname']) || isset($_POST['add-email']) || isset($_POST['add-password']) || isset($_POST['add-role']) ) {

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

    /////////////////////////// UPDATE USERS FROM ADMIN PROFILE CONTROLLER ///////////////////////////////////////////////

    if(isset($_POST['admin-update-id']) || isset($_POST['admin-update-fname']) ||  isset($_POST['admin-update-lname']) || isset($_POST['admin-update-email']) || isset($_POST['admin-update-password']) || isset($_POST['admin-update-role']) ) {

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

    /////////////////////////// UPDATE USER FROM USER PROFILE CONTROLLER ///////////////////////////////////////////////

    if (isset($_POST['user-update-id']) || isset($_POST['user-update-fname']) || isset($_POST['user-update-lname']) || isset($_POST['user-update-email']) ) {

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

    /////////////////////////////////////// GET ALL USERS CONTROLLER ///////////////////////////////////////////////////////////

    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(isset($_GET['users'])) {
            if($_GET['users'] == 'all') {
                $users = ModelDbConnection::get_users();
                if($users) {
                    echo json_encode($users);
                }
                else {
                    ErrorMsgs::msg('Error al cargar usuarios, revise su conexion a intenet');
                }
            }
        }
    }

    if(isset($_GET['usid'])) {
        $usid = $_GET['usid'];
        $userdel = ModelDbConnection::delete_user($usid);
        session_start();
        if($_GET['usid'] == $_SESSION['id']) {
            session_destroy();
            header('Location: ../index.php');
        }
        else {
            if($userdel) {
                header('Location: ../views/admin-table.php');
            }
        }
    }

    function get_user_by_id($usid) {
        $id = $usid;
        $user = ModelDbConnection::get_user($id);
        return $user;
    }

?>