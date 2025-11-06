<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación</title>
    <link rel="stylesheet" href="./VISTA/ESTRUCTURA/styles.css">
</head>
<body>
    <div class="main-container">
        <!-- Card de Registro -->
        <div class="card">
            <h2>Registrarse</h2>
            <form action="./VISTA/ACCION/insertarUsuario.php" method="POST">
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usnombre" required>
                </div>
            
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="uspass" required>
                </div>

                <div class="form-group">
                    <label for="password">Email:</label>
                    <input type="password" id="password" name="usmail" required>
                </div>
                <button type="submit" class="btn-submit btn-login">Registrarse</button>
            </form>
        </div>
        <div class="card">
            <h2>Iniciar Sesión</h2>
            <form action="./VISTA/ACCION/verificarLogin.php" method="POST">
                <div class="form-group">
                    <label for="usuario_login">Usuario:</label>
                    <input type="text" id="usuario_login" name="usnombre" required>
                </div>
                
                <div class="form-group">
                    <label for="password_login">Contraseña:</label>
                    <input type="password" id="password_login" name="uspass" required>
                </div>

                <div class="form-group">
                    <label for="email_login">E-Mail:</label>
                    <input type="password" id="email_login" name="usmail" required>
                </div>
                
                <button type="submit" class="btn-submit btn-login">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>





