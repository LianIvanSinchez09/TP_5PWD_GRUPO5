<?php

include_once __DIR__ . '/../../CONTROL/AbmUsuario.php';
include_once __DIR__ . '/../../MODELO/Usuario.php';
include_once __DIR__ . '/../../UTILS/funciones.php';

$nuevoUsuarioDatos = data_submitted();
$usuario = new AbmUsuario();

$nuevoUsuarioDatos['usuario_deshabilitado'] = time()+60*60*24*30;

if($usuario->alta($nuevoUsuarioDatos)){
    header("Location: ../paginaSegura.php");
}else{
    header("Location: ../../index.php");
    echo "Error al registrar el usuario.";
}

$mensaje = $usuario->alta($nuevoUsuarioDatos);
echo $mensaje;


