<?php
    require 'models/usersModel.php';
    require 'utils/validation.php';
    require 'utils/hash.php';
    require 'utils/error-msgs.php';

    //////////////////////////////////// LOGIN CONTROLLER ///////////////////////////////////////////////

    function login($username, $password) {
        
        $res = ModelDbConnection::login($username, $password);
        if($res) {
            $get_data = ModelDbConnection::get_user_email($username);
            if(verifier($get_data['Password'], $password) && $username == $get_data['Email']) {
                
                $_SESSION['id'] = $get_data['UserID'];
                $_SESSION['user'] = $get_data['FirstName'];
                $_SESSION['email'] = $get_data['Email'];
                $_SESSION['role'] = $get_data['Role'];
                header('Content-Type: application/json',true,302);
                echo json_encode('OK');
            }
            else {
                header('Content-Type: application/json',true,400);
                ErrorMsgs::msg('Usuario y/o contrasena incorrectos');
                exit;
            }    
        }
    }

    /////////////////////////// ADD NEW USER CONTROLLER ///////////////////////////////////////////////

    function add_user($firstname, $lastname, $username, $password, $role) {        
        $res = ModelDbConnection::create($firstname, $lastname, $username, $password, $role);
        if($res) {
            header('Content-Type: application/json',true,201);
            echo json_encode('OK');
        }
        else {
            header('Content-Type: application/json',true,400);
            ErrorMsgs::msg('Revisa los datos y vuelve a intentarlo');
            exit;
        }
    }

    /////////////////////////// UPDATE USER ///////////////////////////////////////////////

    function update_user($user_id, $user_fname, $user_lname, $user_email, $user_password, $user_role) {
        try {
            $update = ModelDbConnection::admin_update($user_id, $user_fname, $user_lname, $user_email, $user_password, $user_role);
            if($update) {
                header('Content-Type: application/json',true,200);
                echo json_encode('OK');
            }
            else {
                header('Content-Type: application/json',true,400);
                ErrorMsgs::msg('Error al actualizar usuario, verifique los datos y vuelva a intentar');    
            }
        }
        catch(mysqli_sql_exception $e) {
            header('Content-Type: application/json',true,400);
            ErrorMsgs::msg('Error al actualizar usuario, verifique los datos y vuelva a intentar');
        }
    }

    /////////////////////////////////////// GET ALL USERS CONTROLLER ///////////////////////////////////////////////////////////

    function get_users() {
        $users = ModelDbConnection::get_users();
        if($users) {
            header('Content-Type: application/json',true,200);
            echo json_encode($users);
        }
        else {
            header('Content-Type: application/json',true,400);
            ErrorMsgs::msg('Error al cargar usuarios, revise su conexion a intenet');
        }
    }

    ///////////////////////////////logout/////////////////////////////////////////////////////////////////////

    function logout() {
        session_destroy();
        header('Location: /system');
    }

    ////////////////////////////////DELETE USER//////////////////////////////////////////////////////////////

    function delete_user($uid) {
        $userdel = ModelDbConnection::delete_user($uid);
        if($uid == $_SESSION['id']) {
            session_destroy();
            header(302);
            header('Location: /system');
        }
        else {
            if($userdel) {
                header(302);
                header('Location: /system');
            }
        }
    }

    ///////////////////////////////////////GET USER/////////////////////////////////////////////////////////

    function get_user_by_id($usid) {
        $id = $usid;
        $user = ModelDbConnection::get_user($id);
        return $user;
    }

?>