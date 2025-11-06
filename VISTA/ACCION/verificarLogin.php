<?php

include_once '../../CONTROL/AbmUsuario.php';
include_once '../../MODELO/Usuario.php';
include_once '../../UTILS/funciones.php';
include_once "../../CONTROL/Session.php";

$abmUsuario = new AbmUsuario();
$usuario = data_submitted();
$session = new Session();

// print_r($usuario);

// Buscar el usuario en la base de datos
$condicion = array(
    'usuario_nombre' => $usuario['usnombre'],
    'usuario_password' => $usuario['uspass'],
    'usuario_mail' => $usuario['usmail']
);
$listaUsuarios = $abmUsuario->buscar($condicion);

if (count($listaUsuarios) > 0) {
    // Usuario encontrado, iniciar sesión
    $session->iniciar($usuario['usnombre'], $usuario['uspass']);
    if ($session->validar()) {
        header('Location: ../paginaSegura.php');
    }
} else {
    $message = "Usuario o contraseña incorrectos";
    header('Location: ../../index.php?message=' . urlencode($message));
}


