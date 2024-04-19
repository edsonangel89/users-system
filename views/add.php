<?php
    session_start();
    if(!$_SESSION) {
        header('Location: ../index.php');
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
    <title>Agregar usuario</title>
</head>
<body>
    <main>
        <div id="add-form" class="add-form-container">
            <form id='add-form'>
                <div class="label">
                    <label>Nombre(s)</label>
                </div>
                <div class="input">
                    <input id='add-fname' type="text" maxlength=35 required/>
                </div>
                <div class="label">
                    <label>Apellido(s)</label>
                </div>
                <div class="input">
                    <input id='add-lname' type="text" maxlength=35 required/>
                </div>
                <div class="label">
                    <label>Correo electrónico</label>
                </div>
                <div class="input">
                    <input id='add-email' type="email" maxlength=35 required/>
                </div>
                <div class="label">
                    <label>Contraseña</label><span class='contrasena-alert'>No coinciden las contrenas</span>
                </div>
                <div class="input">
                    <input id='add-password' type="password" maxlength=30 required/>
                </div>
                <div class="label">
                    <label>Confirmar contraseña</label><span class='contrasena-alert'>No coinciden las contrenas</span>
                </div>
                <div class="input">
                    <input id='add-confirm-password' type="password" maxlength=30 required/>
                </div>
                <div class="label">
                    <label>Rol</label>
                </div>
                <div class="input" >
                    <select id='add-role' name='add-role'>
                        <option value='admin'>Administrador</option>
                        <option value='user'>Usuario</option>
                    </select>
                </div>
                <div class="input-submit-add">
                    <input type="submit" value="Agregar"/>
                </div>
            </form>
        </div>
    </main>
    <script src='../public/js/addForm.js'></script>
</body>
</html>