<?php

    class ModelDbConnection {

        /////////////////////////////LOGIN////////////////////////////////////////////

        public static function login($usr, $pass) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            try{
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                $log = $conn->query("SELECT * FROM $dbtable WHERE Email = '$usr'");
                $conn->close();
                if($log->num_rows > 0) {
                    return TRUE;    
                }
                else {
                    ErrorMsgs::msg('Usuario y/o contrasena incorrectos');
                    exit;
                }
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg($e->getMessage());
                exit;
            }
        }

        /////////////////////////////CREATE USER////////////////////////////////////////////

        public static function create($fname, $lname, $email, $pass, $role) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            $hashed_pass = hasher($pass);
            $sql_create = "INSERT INTO users(
                FirstName,
                LastName,
                Email,
                Password,
                Role
            ) VALUES (
                '$fname',
                '$lname',
                '$email',
                '$hashed_pass',
                '$role'
            )";
            
            try{
                $hashed_pass =  hasher($password);
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                if($conn->query($sql_create) === TRUE) {
                    return TRUE;
                }
                else {
                    ErrorMsgs::msg('Error al guardar en BD');
                    exit;
                }
                $conn->close();
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg('Usuario ya existe'); 
                exit;
            }
        }

        /////////////////////////////DELETE USER////////////////////////////////////////////

        public static function delete_user($id) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            $sql_del = "DELETE FROM $dbtable WHERE UserID = $id";
            try{
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                if($conn->query($sql_del)) {
                    return TRUE;
                }
                $conn->close();
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg('Usuario no existe'); 
                exit;
            }
        }

        /////////////////////////////GET USER////////////////////////////////////////////
        
        public static function get_user($usr) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            try {
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                $log = $conn->query("SELECT * FROM $dbtable WHERE UserID = '$usr'");
                if($log->num_rows > 0) {
                    $result = $log->fetch_assoc();
                    return $result;    
                }
                else {
                    ErrorMsgs::msg('Usuario no encontrado');
                    exit;
                }
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg(e->getMessage());
                exit;
            }
        }

        /////////////////////////////GET CURRENT USER EMAIL////////////////////////////////////////////

        public static function get_user_email($usr) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            try {
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                $log = $conn->query("SELECT * FROM $dbtable WHERE Email = '$usr'");
                if($log->num_rows > 0) {
                    $result = $log->fetch_assoc();
                    return $result;    
                }
                else {
                    ErrorMsgs::msg('Usuario no encontrado');
                    exit;
                }
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg(e->getMessage());
                exit;
            }
        }

        /////////////////////////////GET ALL USERS////////////////////////////////////////////

        public static function get_users() {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';

            try {
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                $log = $conn->query("SELECT UserID, FirstName, LastName, Email, Role FROM $dbtable ");
                if($log->num_rows > 0) {
                    $users = [];
                    while($row = $log->fetch_assoc()) {
                        $users[] = $row;
                    }
                    return $users;    
                }
                else {
                    ErrorMsgs::msg('Usuario no encontrado');
                    exit;
                }
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg('Error al consultar usuarios');
                exit;
            }
        }

        /////////////////////////////UPDATE USER FROM ADMIN PROFILE////////////////////////////////////////////

        public static function admin_update($id, $fname, $lname, $email, $pass, $role) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            $get = new mysqli($serverdb, $user, $password, $dbname);
            $log = $get->query("SELECT * FROM $dbtable WHERE UserID = '$id'");
            if($log->num_rows > 0) {
                $result = $log->fetch_assoc();    
            }
            $userId = $result['UserID'];
            $get->close();
            if(!empty($pass)) {
                $hashed_pass = hasher($pass);
                $sql_update = "UPDATE $dbtable SET
                FirstName='$fname',
                LastName='$lname',
                Email='$email',
                Password='$hashed_pass',
                Role='$role' WHERE UserID='$id'
             ";
            }
            else {
                $sql_update = "UPDATE $dbtable SET
                FirstName='$fname',
                LastName='$lname',
                Email='$email',
                Role='$role' WHERE UserID='$id'
             ";
            }
            try{
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                if($conn->query($sql_update)) {
                    session_start();
                    $_SESSION['user'] = $fname;
                    if($role == 'admin') {
                        $_SESSION['role'] = 'admin';
                    }
                    elseif($role == 'user') {
                        $_SESSION['role'] = 'user';
                    }
                    return TRUE;
                }
                $conn->close();
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg('Error al actualizar el usuario');
                exit;
            }
        }

        /////////////////////////////UPDATE USER FROM USER PROFILE////////////////////////////////////////////

        public static function user_update($id, $fname, $lname, $email) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            $get = new mysqli($serverdb, $user, $password, $dbname);
            $log = $get->query("SELECT * FROM $dbtable WHERE UserID = '$id'");
            if($log->num_rows > 0) {
                $result = $log->fetch_assoc();    
            }
            $userId = $result['UserID'];
            $get->close();
            $sql_update = "UPDATE $dbtable SET
            FirstName='$fname',
            LastName='$lname',
            Email='$email' WHERE UserID='$userId'
            ";
            try {
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                if($conn->query($sql_update)) {
                    session_start();
                    $_SESSION['user'] = $fname;
                    return TRUE;
                }
                $conn->close();
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg('Error al actualizar usuario, verifique los datos y vuelva a intentar');
            }
        }
    }
?>