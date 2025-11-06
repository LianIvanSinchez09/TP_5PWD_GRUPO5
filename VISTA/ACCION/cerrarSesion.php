<?php

include_once '../../CONTROL/Session.php';

$sesion = new Session();

if ($sesion->validar()) {
    $sesion->cerrar();
}

header("Location: ../../index.php");
exit();