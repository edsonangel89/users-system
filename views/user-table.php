<?php
    session_start();
    if(!$_SESSION) {
        header('Location: ../index.php');
    }
    else {
        if($_SESSION['role'] != 'user') {
            header('Location: ../index.php');
        }
        $user = $_SESSION['user'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='X-Content-Type-Options' content='nosniff' >
    <meta http-equiv='X-XSS-Protection' content='1; mode=block' >
    <meta http-equiv='Strict-Transport-Security' content='max-age=31536000; includeSubDomains; preload' >
    <meta http-equiv='referrer' content='no-referrer' >
    <meta http-equiv='Feature-Policy' content="geolocation 'self'" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel='stylesheet' href='../public/css/table.css'/>
    <title>Usuarios</title>
</head>
<body>
    <header>
        <nav>
            <div class="navbar navbar-left">
                <p><?php echo 'Hola ' . $test?></p>
            </div>
            <div class="navbar navbar-right">
                <a href="../views/add.php"><span class="material-symbols-outlined">person_add</span></a>
                <a href="../controllers/views-controller.php?logout=true"><span class="material-symbols-outlined">logout</span></a>
            </div>
        </nav>
    </header>
    <main>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <td>Nombres</td>
                        <td>Apellido</td>
                        <td>Correo</td>
                        <td>Rol</td>
                    </tr>
                </thead>
                <tbody id='user-table'>
                </tbody>
            </table>
        </div>
    </main>
    <script src='../public/js/tableUser.js'></script>
</body>
</html>