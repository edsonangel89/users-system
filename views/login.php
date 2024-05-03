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
    <title>Login</title>
</head>
<body>
    <main>
        <div class="form-container">
            <form id='login-form'>
                <div class="label">
                    <label>Correo electrónico</label>
                </div>
                <div class="input">
                    <input id='login-email' type="email" maxlength=35 required/>
                </div>
                <div class="label">
                    <label>Contraseña</label>
                </div>
                <div class="input">
                    <input id='login-password' type="password" maxlength=30 required autocomplete='true'/>
                </div>
                <div class="input-submit-login">
                    <input type="submit" value="Iniciar sesión"/>
                </div>
            </form>
        </div>
    </main>
    <script src='public/js/loginScript.js'></script>
</body>
</html>