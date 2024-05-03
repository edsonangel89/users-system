<?php
    session_start();
    $main_routes = [
        '/' => 'routes/viewRoutes.php',
        '/api/users' => 'routes/userRoutes.php',
        '404' => 'views/404.php'
    ];

    define('REQUEST_URI', $_SERVER['REQUEST_URI']);
    
    $path = '/' . ltrim(parse_url(REQUEST_URI, PHP_URL_PATH), '/system');
    define('PATH', $path);

    /*echo json_encode($path);
    exit;*/

    if(!$_SESSION && $path == '/') {
        $path = $path . 'log';
    }
    elseif ($_SESSION && $path == '/') {
        $path = $path . 'table';
    }

    
    //echo json_encode($path);
    //echo json_encode($path);
    //exit;

    if (preg_match_all('/\//', $path) == 1) {
        require $main_routes['/'];
        exit;
    }
    elseif (preg_match('[/api/users]', $path)) {
        require $main_routes['/api/users'];
        exit;
    }
    else {
        require $main_routes['404'];
    }

    /*
    if(array_key_exists()) {

    }
    else {

    }
    */
    
    //echo json_encode($res);
    //echo json_encode($_SERVER['SCRIPT_NAME']);
    //exit;

    //$request = $_SERVER['REQUEST_METHOD'];

    /*
    echo json_encode($url);
    exit;
    */
    /*
    $root_path = substr(ABS_PATH, 7);
    $url_path = substr($url, 7);
    */
    /*
    echo json_encode($root_path);
    exit;
    */
    /*
    if(isset($url)) {
        if(isset($main_routes[$url_path])) {
            require $main_routes[$url_path];
        }
        else {
            require $main_routes['404'];
        }
    }
    */
    //echo json_encode(ABS_PATH);
    //echo json_encode($_SERVER['REQUEST_URI']);
    //exit;

?>