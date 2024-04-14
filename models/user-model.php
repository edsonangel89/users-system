<?php

    class User {
        public $fname;
        public $lname;
        public $email;
        public $password;
        public $role;

        function __construct($fname, $lname, $email, $password, $role) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->password = $password;      
            $this->role = $role;  
        }

        function create_user() {

        }

        function update_user() {
            
        }

        function delete_user() {
            
        }
    }
?>