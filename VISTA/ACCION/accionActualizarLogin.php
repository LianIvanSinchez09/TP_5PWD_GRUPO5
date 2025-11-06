<?php

include_once "../../UTILS/funciones.php";


$datos = data_submitted();
$abmUsuario = new AbmUsuario();

// Paso 1: Obtener el objeto de la base de datos para recuperar 'usdeshabilitado'
$usuarioBusqueda = ['idusuario' => $datos['idusuario']];

$listaUsuario = $abmUsuario->buscar($usuarioBusqueda);

if (count($listaUsuario) > 0) {
    $objUsuario = $listaUsuario[0];

    // Paso 2: Agregar 'usdeshabilitado' al arreglo $datos con la clave correcta
    // Usamos 'usdeshabilitado' para que coincida con el get y set en Usuario.php
    $datos['usdeshabilitado'] = $objUsuario->getUsDeshabilitado(); 
    
    // Paso 3: Modificar con el objeto completo (incluye idusuario, usnombre, uspass, usmail y usdeshabilitado)
    $abmUsuario->modificar($datos);
}

header('Location: ../../index.php');