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

    if(!$_SESSION && $path == '/') {
        $path = $path . 'log';
    }
    elseif ($_SESSION && $path == '/') {
        $path = $path . 'table';
    }

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

?>