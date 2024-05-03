<?php

    function get_login_form() {
        require 'views/login.php';
    }

    function get_add_form() {
        require 'views/add.php';
    }

    function get_update_form() {
        require 'views/update.php';
    }

    function get_table() {
        require 'views/table.php';
    }

    function not_found() {
        require 'views/404.php';
    }

?>