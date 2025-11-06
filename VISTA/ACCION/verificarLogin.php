<?php

include_once '../CONTROL/AbmUsuario.php';
include_once '../MODELO/Usuario.php';
include_once '../../UTILS/funciones.php';

$nuevoUsuarioDatos = data_submitted();



$usuario = new AbmUsuario();
