<?php
    class ErrorMsgs {
        public static function msg($msg) {
            echo json_encode('Error ' . $msg);
        }
    }
?>