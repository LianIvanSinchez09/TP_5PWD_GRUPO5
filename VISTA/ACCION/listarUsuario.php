<?php

include_once "../../UTILS/funciones.php";


$session = new Session();
if (!$session->validar()) {

}


$titulo = "Lista Usuarios";

$objControl = new AbmUsuario();
$resultado = $objControl->buscar(NULL);

$param = data_submitted();

?>

<!-- Listado -->
<main class="col-12 my-3 d-flex align-items-center justify-content-center flex-column">
    <div class="col-12 col-md-6">
        <h1 class="text-center">Usuarios</h1>
        <?php
        if(isset($param["error"])){
            echo mostrarError(getError($param["error"]));
        }elseif(isset($param["exito"])){
            echo mostrarExito("La acción se concretó con éxito.");
        }

        if(count($resultado)>0){
            echo mostrarUsuarios($resultado);
        }else{
            echo mostrarError("No hay usuarios registrados.");
        }

        ?>
        <a class="btn btn-primary" href="../../paginaSegura.php"><< Volver</a>
    </div>
</main>

<?php

?>