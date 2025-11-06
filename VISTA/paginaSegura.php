<html>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pagina Segura</title>
    </head>
    <body>
<<<<<<< HEAD
        <h1>Inserte frontend de pagina segura</h1>
=======
        
        <h1>Bienvenido/a</h1>
        <?php
            include_once "../CONTROL/Session.php";
            $sesion = new Session();
            if ($sesion->activa() && $sesion->validar()) {
                $nombreUsuario = $sesion->getUsuario();
                echo "<p>Usuario actual: " . $nombreUsuario . "</p>";
            }
        ?>
>>>>>>> 2db86f789e5be0649266bc777fe0472e0b3955ad
        <form action="./ACCION/cerrarSesion.php" method="POST">
            <button type="submit">Cerrar Sesion</button>
        </form>
    </body>
    </html>