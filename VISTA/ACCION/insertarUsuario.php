<?php

include_once '../../CONTROL/AbmUsuario.php';
include_once '../../MODELO/Usuario.php';
include_once '../../UTILS/funciones.php';

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


