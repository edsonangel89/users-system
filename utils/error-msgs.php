<?php

    require '../vendor/autoload.php';

    class ErrorMsgs {
        public static function msg($msg) {
            
            $log = new Monolog\Logger('System');
            $log->pushHandler(new Monolog\Handler\StreamHandler('../errors.log', Monolog\Logger::WARNING));
            $log->error($msg);
            echo json_encode('Error ' . $msg);
            exit;
        }
    }
?>