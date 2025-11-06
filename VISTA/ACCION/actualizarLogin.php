<?php

include_once "../../UTILS/funciones.php";

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

$usuario = ['id_usuario' => $datos['id_usuario']];

$listaUsuario = $abmUsuario->buscar($usuario);
$objUsuario = $listaUsuario[0];

$datos['usuario_deshabilitado'] = $objUsuario->getUsDeshabilitado();

$abmUsuario->modificar($datos);

header('Location: ../../index.php');
