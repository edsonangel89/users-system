<?php

    //echo json_encode($_SERVER['CONTEXT_PREFIX'] . '/');
    //exit;

    define('ABS_PATH', $_SERVER['CONTEXT_PREFIX'] . '/');
    
    //header('Location: login');
    //$_SERVER['REQUEST_URI'] = '/login';

    //echo json_encode($_SERVER['REQUEST_URI']);
    //exit;
    
    /*
    if(!$_SESSION) {
        header('Location: login');
        exit;
    }
    else {
        header('Location: users');
        exit;
    }
    */
    require 'routes/index.php';

    //echo json_encode($_SERVER['REQUEST_URI']);
    //exit;

    if(isset($_SERVER['REQUEST_METHOD'])) {
        $log_file = fopen('req.log', 'a');
        foreach($_SERVER as $data) {
            fwrite($log_file, $data . ' ');
        }
        fclose($log_file);   
    }
    require 'utils/database-init.php'; 
    //require 'controllers/views-controller.php';

?>