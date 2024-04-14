<?php
    session_start();
    if(!$_SESSION) {
        header('Location: ../index.php');
    }
    else {
        if($_SESSION['role'] != 'admin') {
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
    <link rel='stylesheet' href='../public/css/form.css'/>
    <title>Modificar usuario</title>
</head>
<body>
    <main>
        <div id="admin-update-form" class="form-container">
            <form id='update-admin-form'>
                <div class="label">
                    <label>Nombre(s)</label>
                </div>
                <div class="input">
                    <input id='admin-update-fname' type="text"/>
                </div>
                <div class="label">
                    <label>Apellido(s)</label>
                </div>
                <div class="input">
                    <input id='admin-update-lname' type="text"/>
                </div>
                <div class="label">
                    <label>Correo electrónico</label>
                </div>
                <div class="input">
                    <input id='admin-update-email' type="email"/>
                </div>
                <div class="label">
                    <label>Contraseña</label>
                </div>
                <div class="input">
                    <input id='admin-update-password' type="password"/>
                </div>
                <div class="label">
                    <label>Confirmar contraseña</label>
                </div>
                <div class="input">
                    <input id='admin-update-confirm-password' type="password"/>
                </div>
                <div class="label">
                    <label>Rol</label>
                </div>
                <div class="input">
                    <select id='admin-update-role'>
                        <option value='admin'>Administrador</option>
                        <option value='user'>Usuario</option>
                    </select>
                </div>
                <div class="input-submit">
                    <input type="submit" value="Actualizar"/>
                </div>
            </form>
        </div>
    </main>
    <script src='../public/js/updateAdmin.js'></script>
</body>
</html>
