<?php

include_once 'conector/BaseDatos.php';

class Rol {

    private $idRol;
    private $rolDescripcion;
    private $mensajeOperacion;

    public function __construct() {
        $this->idRol = "";
        $this->rolDescripcion = "";
        $this->mensajeOperacion = "";
    }

    public function getIdRol() {
        return $this->idRol;
    }
    public function getRolDescripcion() {
        return $this->getRolDescripcion;
    }
    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }
    public function setIdRol($newIdRol) {
        $this->idRol = $newIdRol;
    }
    public function setRolDescripcion($newRolDescripcion) {
        $this->rolDescripcion = $newRolDescripcion;
    }
    public function setMensajeOperacion($newMensaje) {
        $this->mensajeOperacion = $newMensaje;
    }

    public function setear($idRol, $rolDescripcion) {
        $this->setIdRol($idRol);
        $this->setRolDescripcion($rolDescripcion);
    }

    public function cargar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM 'rol' WHERE id_rol = " . $this->getIdRol();

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear(
                        $row['id_rol'],
                        $row['rol_descripcion'],
                    );
                }
        } else {
            $this->setMensajeOperacion("Tabla->Listar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE rol SET rol_descripcion '{$this->getRolDescripcion()}' WHERE id_rol = '" . $this->getIdRol() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("Rol->Modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->Modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM 'rol' WHERE id_rol = '" . $this->getIdRol() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
            $resp = true;
            } else {
            $this->setMensajeOperacion("Rol->Modificar: " . $base->getError());
            }
            } else {
        $this->setMensajeOperacion("Rol->Modificar: " . $base->getError());
        }
    return $resp;
    }


    public function listar($param = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol ";
        if ($param != "") {
            $sql .= ' WHERE ' . $param;
        }
        $res = $base->Ejecutar($sql);
        if ($res > 0) {
            while ($row = $base->Registro()) {
                $objRol = new Rol();
                $objRol->setear(
                    $row['id_rol'],
                    $row['rol_descripcion'],
                );
                array_push($arreglo, $objRol);
            }
        } else {
            $this->setMensajeOperacion("Tabla->Listar: " . $base->getError());
        }
        return $arreglo;
    } 

    public function insertar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO rol (rol_descripcion) VALUES('" . $this->getRolDescripcion() . "')";
        if ($base->Iniciar()) {
            if ($id = $base->Ejecutar($sql)) {
                $this->setIdRol($id);
                $resp = true;
            } else {
                $this->setMensajeOperacion("Rol->Insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Rol->Insertar: " . $base->getError());
        }
        return $resp;
    }
}

