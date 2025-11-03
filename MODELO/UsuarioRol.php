<?php
class UsuarioRol
{
    private $objUsuario;
    private $objRol;
    private $mensajeOperacion;

    public function __construct(){
        $this->objUsuario=null;
        $this->objRol=null;
        $this->mensajeOperacion=null;
    }

    public function setear($objUsuario, $objRol){
        $this->objUsuario=$objUsuario;
        $this->objRol=$objRol;
    }

    //GETS

    public function getObjUsuario(){
        return $this->objUsuario;
    }

    public function getObjRol(){
        return $this->objRol;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }

    //SETS

    public function setObjUsuario($objUsuario){
        $this->objUsuario = $objUsuario;
    }

    public function setObjRol($objRol){
        $this->objRol = $objRol;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE id_usuario= " . $this->getObjUsuario()->getIdUsuario() . " AND id_rol= " . $this->getObjRol()->getIdRol();
        
        if($base->Iniciar()){
            $res = $base->Ejecutar($sql);

            if($res > 0){
                $objRol = null;
                $objUsuario = null;
                $row = $base->Registro();

                if($row["id_rol"] != null){
                    $objRol = new Rol();
                    $objRol->setIdRol($row["idrol"]);
                    $objRol->cargar();
                }
                if($row["id_usuario"] != null){
                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($row["id_usuario"]);
                    $objUsuario->cargar();
                }
                $this->setear($objUsuario, $objRol);
            }
        } else {
            $this->setMensajeOperacion("usuario_rol->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();

        $sql = "INSERT INTO usuario_rol(id_usuario, id_rol)VALUES(" . $this->getObjUsuario()->getIdUsuario() . "," . $this->getObjRol()->getIdRol() . ");";
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $resp = true;
            } else {
                $this->setMensajeOperacion("usuario_rol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("usuario_rol->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario_rol SET id_rol = " . $this->getObjRol()->getIdRol() . "WHERE id_usuario = " . $this->getObjUsuario()->getIdUsuario();

        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $resp = true;
            } else {
                $this->setMensajeOperacion("usuario_rol->modificar 1: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("usuario_rol->modificar 2: " . $base->getError());
        }
    }

    public static function listar($parametro = ""){
        $resultado = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario_rol ";
        //echo $sql;
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        //  echo $sql;

        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {

                    $objUsuario = null;
                    $objRol = null;

                    if ($row['id_rol'] != null) {
                        $objRol = new Rol();
                        $objRol->setIdRol($row['id_rol']);
                        $objRol->cargar();
                    }

                    if ($row['id_usuario'] != null) {
                        $objUsuario = new Usuario();
                        $objUsuario->setIdUsuario($row['id_usuario']);
                        $objUsuario->cargar();
                    }

                    $obj = new UsuarioRol();
                    $obj->setear($objUsuario, $objRol);
                    array_push($resultado, $obj);
                }
            }
        } else {
            //     $this->setmensajeoperacion("reclamo->listar: ".$base->getError());
        }
        return $resultado;
    }

}

?>