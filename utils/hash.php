<?php
    function hasher($pass) {
        $password = $pass;
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        return $hashed_password;
    }

    function verifier($dbpass, $userpass) {
        $database_password = $dbpass;
        $user_password = $userpass;
        if(password_verify($user_password, $database_password)) {
            //echo 'Correct';
            return true;
        }
        else {
            //echo 'Incorrect';
            return false;
        }
    }
?>