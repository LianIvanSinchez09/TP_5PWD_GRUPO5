<?php

include_once '../CONTROL/AbmUsuario.php';
include_once '../MODELO/Usuario.php';
include_once '../../UTILS/funciones.php';

$nuevoUsuarioDatos = data_submitted();
$session = new Session();

$session->iniciar($usuario['username'], $usuario['password']);
if ($session->validar()) {
    header('Location: ../paginaSegura.php');
} else {
    $message = "Error al iniciar sesion";
    header('Location: ../../index.php?message=' .urlencode($message));
}


