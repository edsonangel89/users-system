<?php
    include '../utils/get-user.php';

    session_start();
    if(!$_SESSION) {
        header('Location: ../index.php');
    }
    else {
        if($_SESSION['role'] != 'admin') {
            header('Location: ../index.php');
        }
        if(isset($_GET['email'])) {
            $email = $_GET['email'];
            $user_data = user($email);
        }
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
                    <input id='admin-update-fname' type="text" value='<?php echo $user_data['FirstName']?>'/>
                </div>
                <div class="label">
                    <label>Apellido(s)</label>
                </div>
                <div class="input">
                    <input id='admin-update-lname' type="text" value='<?php echo $user_data['LastName']?>'/>
                </div>
                <div class="label">
                    <label>Correo electrónico</label>
                </div>
                <div class="input">
                    <input id='admin-update-email' type="email" value='<?php echo $user_data['Email']?>'/>
                </div>
                <div class="label">
                    <label>Contraseña</label>
                </div>
                <div class="input">
                    <input id='admin-update-password' type="password" value='<?php echo $user_data['Password']?>'/>
                </div>
                <div class="label">
                    <label>Confirmar contraseña</label>
                </div>
                <div class="input">
                    <input id='admin-update-confirm-password' type="password" value='<?php echo $user_data['Password']?>'/>
                </div>
                <div class="label">
                    <label>Rol</label>
                </div>
                <div class="input">
                    <select id='admin-update-role'>
                        <?php
                            if($user_data['Role'] == 'admin') { 
                                echo "
                                <option value='admin'>Administrador</option>
                                <option value='user'>Usuario</option>";
                            }
                            elseif ($user_data['Role'] == 'user') {
                                echo "
                                <option value='user'>Usuario</option>
                                <option value='admin'>Administrador</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="input-submit-add">
                    <input type="submit" value="Actualizar"/>
                </div>
            </form>
        </div>
    </main>
    <script src='../public/js/updateAdmin.js'></script>
</body>
</html>
