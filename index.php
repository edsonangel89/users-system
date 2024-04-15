<?php
    if(isset($_SERVER['REQUEST_METHOD'])) {
        $log_file = fopen('logs.txt', 'a');
        foreach($_SERVER as $data) {
            fwrite($log_file, $data . ' ');
        }
        fclose($log_file);   
    }
    require 'utils/database-init.php'; 
    require 'controllers/views-controller.php'
    
?>