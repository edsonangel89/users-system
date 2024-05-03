<?php

    require 'controllers/usersController.php';
    
    if(!$_SESSION) {
        header('Location: /system');
    }
    else {
        if(isset($_GET['get-user'])) {
            $id = $_GET['get-user'];
            $user_data = get_user_by_id($id);
        }
        $role = $_SESSION['role'];
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
    <link rel='stylesheet' href='public/css/form.css'/>
    <title>Modificar usuario</title>
</head>
<body>
    <main>
        <?php
            if($role == 'user') {
            echo "
                <div id='user-update-form' class='add-form-container'>
                    <form id='update-user-form'>
                        <div class='label'>
                            <label>ID</label>
                        </div>
                        <div class='input'>
                            <input id='user-update-id' type='text' value=" . $user_data['UserID'] . " required disabled/>
                        </div>
                        <div class='label'>
                            <label>Nombre(s)</label>
                        </div>
                        <div class='input'>
                            <input id='user-update-fname' type='text' maxlength='35' value=" . $user_data['FirstName'] . " required/>
                        </div>
                        <div class='label'>
                            <label>Apellido(s)</label>
                        </div>
                        <div class='input'>
                            <input id='user-update-lname' type='text' maxlength='35' value=" . $user_data['LastName'] . " required/>
                        </div>
                        <div class='label'>
                            <label>Correo electrónico</label>
                        </div>
                        <div class='input'>
                            <input id='user-update-email' type='email' maxlength='35' value=" . $user_data['Email'] . " required/>
                        </div>
                        <div class='input-submit-login'>
                            <input type='submit' value='Actualizar'/>
                        </div>
                    </form>
                </div> ";
            }
            elseif ($role == 'admin') {
                echo "
                    <div id='admin-update-form' class='update-form-container'>
                        <form id='update-admin-form'>
                            <div class='label'>
                                <label>ID</label>
                            </div>
                            <div class='input'>
                                <input id='admin-update-id' type='text' value=" . $user_data['UserID'] . " required disabled/>
                            </div>
                            <div class='label'>
                                <label>Nombre(s)</label>
                            </div>
                            <div class='input'>
                                <input id='admin-update-fname' type='text' maxlength='35' value=" . $user_data['FirstName'] . " required/>
                            </div>
                            <div class='label'>
                                <label>Apellido(s)</label>
                            </div>
                            <div class='input'>
                                <input id='admin-update-lname' type='text' maxlength='35' value=" . $user_data['LastName'] . " required/>
                            </div>
                            <div class='label'>
                                <label>Correo electrónico</label>
                            </div>
                            <div class='input'>
                                <input id='admin-update-email' type='email' maxlength='35' value=" . $user_data['Email'] . " required/>
                            </div>
                            <div class='checkbox'>
                                <label>Cambiar contrasena</label>
                                <input id='admin-update-checkbox' type='checkbox' />
                            </div>
                            <div class='label'>
                                <label>Contraseña</label><span class='contrasena-alert'>No coinciden las contrenas</span>
                            </div>
                            <div class='input'>
                                <input id='admin-update-password' type='password' maxlength='30' required disabled/>
                            </div>
                            <div class='label'>
                                <label>Confirmar contraseña</label><span class='contrasena-alert'>No coinciden las contrenas</span>
                            </div>
                            <div class='input'>
                                <input id='admin-update-confirm-password' type='password' maxlength='30' required disabled/>
                            </div>
                            <div class='label'>
                                <label>Rol</label>
                            </div>
                            <div class='input'>
                                <select id='admin-update-role'>"; ?>
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
                                    <?php echo "
                                </select>
                            </div>
                            <div class='input-submit-add'>
                                <input type='submit' value='Actualizar'/>
                            </div>
                        </form>
                </div> "; 
            }
        ?>
    </main>
    <?php
        if($role == 'admin') {
            echo "<script src='public/js/updateAdmin.js'></script>";
        }
        elseif($role == 'user') {
            echo "<script src='public/js/updateUser.js'></script>";
        }
    ?>
</body>
</html>
