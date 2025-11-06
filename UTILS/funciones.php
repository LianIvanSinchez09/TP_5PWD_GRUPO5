<?php

include_once __DIR__ . '/../CONTROL/AbmUsuario.php';
include_once __DIR__ . '/../CONTROL/AbmRol.php';
include_once __DIR__ . '/../CONTROL/Session.php';
include_once __DIR__ . '/../CONTROL/tp5_control.php';

function verificarUsuario(Usuario $usuario) {
    $abmUsuario = new AbmUsuario();
    $listaUsuarios = $abmUsuario->buscar(['usnombre' => $usuario->getUsNombre(), 'uspass' => $usuario->getUsPass()]);
    $cantidad = count($listaUsuarios);
    $usuarioEncontrado = false;

    if ($cantidad > 0) {
        $usuarioEncontrado = true;
    }
    return $usuarioEncontrado;
}

function data_submitted()
{
    $_AAux = array();
    if (!empty($_POST)) {
        $_AAux = $_POST;
    } else
    if (!empty($_GET)) {
        $_AAux = $_GET;
    }
    if (count($_AAux)) {
        foreach ($_AAux as $indice => $valor) {
            if ($valor == "") {
                $_AAux[$indice] = 'null';
            }

        }
    }
    return $_AAux;
}