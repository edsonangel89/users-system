<?php
    
    class ModelDbConnection {
         
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
                }
                $conn->close();
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg('Usuario ya existe'); 
                exit;
            }
        }

        public static function delete($email) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            $sql_del = "SELECT FROM $dbtable WHERE Email = $email";
            try{
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                $conn->query($sql_del);
                $conn->close();
                return TRUE;
            }
            catch(mysqli_sql_exception $e) {
                ErrorMsgs::msg('Usuario no existe'); 
                exit;
            }
        }
        
        public static function get_data($usr) {
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
            catch(mysqli_sql_excepction $e) {
                ErrorMsgs::msg(e->getMessage());
                exit;
            }
        }

        public static function get_users() {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';

            try {
                $conn = new mysqli($serverdb, $user, $password, $dbname);
                $log = $conn->query("SELECT FirstName, LastName, Email, Role FROM $dbtable ");
                if($log->num_rows > 0) {
                    //$result = $log->fetch_assoc();
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
            catch(mysqli_sql_excepction $e) {
                ErrorMsgs::msg(e->getMessage());
                exit;
            }
        }
    }
    

        /*public static function admin_update($fname, $lname, $email, $pass, $role) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            try{
                $hashed_pass =  hasher($password);
                $conn = new PDO("mysql:host=$serverdb;dbname=$dbname", $user, $password);
                $sql_defuser = "INSERT INTO $dbtable(
                    FirstName,
                    LastName,
                    Email,
                    Password,
                    Role
                ) VALUES (
                    $fname,
                    $lname,
                    $email,
                    '$hashed_pass',
                    $role
                )";
                $conn = null;}
            catch(PDOException $e) {}
        }*/

        /*public static function user_update($fname, $lname, $email) {
            $serverdb = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'users_database';
            $dbtable = 'users';
            try{
                $hashed_pass =  hasher($password);
                $conn = new PDO("mysql:host=$serverdb;dbname=$dbname", $user, $password);
                $sql_defuser = "INSERT INTO users(
                    FirstName,
                    LastName,
                    Email,
                ) VALUES (
                    $fname,
                    $lname,
                    $email,
                )";
                $conn = null;
            }
            catch(PDOException $e) {}*/
?>