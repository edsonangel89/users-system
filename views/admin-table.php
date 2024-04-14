<?php
    session_start();
    if(!$_SESSION) {
        header('Location: ../index.php');
    }
    else {
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
    <link rel='stylesheet' href='../public/css/table.css'/>
    <title>Usuarios</title>
</head>
<body>
    <header>
        <nav>
            <div class="navbar navbar-left">
                <p><?php echo 'Hola ' . $user;?></p>
            </div>
            <div class="navbar navbar-right">
                <a href="../views/add.php">Agregar usuario</a>
                <a href="../controllers/views-controller.php?logout=true">Cerrar sesión</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <td>Nombres(s)</td>
                        <td>Apellido(s)</td>
                        <td>Correo</td>
                        <td>Rol</td>
                    </tr>
                </thead>
                <tbody id='admin-table'>
                </tbody>
            </table>
        </div>
    </main>
    <script src='../public/js/tableAdmin.js'></script>
    </body>
</html>
