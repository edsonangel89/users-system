<?php
    require('utils/hash.php');

    $serverdb = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'users_database';

    $sql_createdb = "CREATE DATABASE $dbname";
        $sql_createtable = "CREATE TABLE users (
            UserID INT PRIMARY KEY AUTO_INCREMENT,
            FirstName VARCHAR(50) NOT NULL,
            LastName VARCHAR(50) NOT NULL,
            Email VARCHAR(50) UNIQUE NOT NULL,
            Password VARCHAR(255) NOT NULL,
            Role ENUM('admin','user') NOT NULL
        )";
        $hashed_pass = hasher('d3f4ultus3r');
        $sql_defuser = "INSERT INTO users(
            FirstName,
            LastName,
            Email,
            Password,
            Role
        ) VALUES (
            'Admin',
            'Admin',
            'admin@email.com',
            '$hashed_pass',
            'admin'
        )";

    try {
        $conn = new mysqli($serverdb, $user, $password, $dbname);
    }
    catch(mysqli_sql_exception $e) {
        try {
            $conn = new mysqli($serverdb, $user, $password);
            $conn->query($sql_createdb);
            $conn_db = new mysqli($serverdb, $user, $password, $dbname);
            $conn_db->query($sql_createtable);
            $conn_db->query($sql_defuser);
            $conn_db->close();
        }
        catch(mysqli_sql_exception $e) {
            
        }
    }
    
?>