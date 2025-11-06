<?php

require_once __DIR__ . '/../../CONTROL/AbmUsuario.php';
require_once __DIR__ . '/../../MODELO/Usuario.php';
require_once __DIR__ . '/../../UTILS/funciones.php';

$nuevoUsuarioDatos = data_submitted();
$session = new Session();

$session->iniciar($usuario['username'], $usuario['password']);
if ($session->validar()) {
    header('Location: ../paginaSegura.php');
} else {
    $message = "Error al iniciar sesion";
    header('Location: ../../index.php?message=' .urlencode($message));
}


