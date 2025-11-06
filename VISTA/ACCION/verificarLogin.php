<?php

include_once '../../CONTROL/AbmUsuario.php';
include_once '../../MODELO/Usuario.php';
include_once '../../UTILS/funciones.php';
include_once "../../CONTROL/Session.php";

$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$session = new Session();

// Buscar el usuario en la base de datos
$condicion = array(
    'usuario_nombre' => $datos['usuario'],
    'usuario_password' => $datos['psw']
);
$listaUsuarios = $abmUsuario->buscar($condicion);

if (count($listaUsuarios) > 0) {
    // Usuario encontrado, iniciar sesión
    $session->iniciar($datos['usuario'], $datos['psw']);
    if ($session->validar()) {
        header('Location: ../paginaSegura.php');
    }
} else {
    $message = "Usuario o contraseña incorrectos";
    header('Location: ../../index.php?message=' . urlencode($message));
}


