<?php

    if(isset($_SERVER['REQUEST_METHOD'])) {
        $log_file = fopen('req.log', 'a');
        foreach($_SERVER as $data) {
            fwrite($log_file, $data . ' ');
        }
        fclose($log_file);   
    }
    require 'utils/database-init.php'; 
    require 'controllers/views-controller.php';

?>