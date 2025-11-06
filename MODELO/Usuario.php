<?php

include_once 'conector/BaseDatos.php';

class Usuario {
    private $idUsuario;
    private $usNombre;
    private $usPass;
    private $usMail;
    private $usDeshabilitado;
    private $usMensajeOperacion;

    public function __construct() {
        $this->idUsuario="";
        $this->usNombre="";
        $this->usPass="";
        $this->usMail="";
        $this->usDeshabilitado="";
        $this->usMensajeOperacion=null;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }
    public function getUsNombre() {
        return $this->usNombre;
    }
    public function getUsPass() {
        return $this->usPass;
    }
    public function getUsMail() {
        return $this->usMail;
    }
    public function getUsDeshabilitado() {
        return $this->usDeshabilitado;
    }
    public function getMensajeOperacion() {
        return $this->usMensajeOperacion;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    public function setUsNombre($usNombre) {
        $this->usNombre = $usNombre;
    }
    public function setUsPass($usPass) {
        $this->usPass = $usPass;
    }
    public function setUsMail($usMail) {
        $this->usMail = $usMail;
    }
    public function setUsDeshabilitado($usDeshabilitado) {
        $this->usDeshabilitado = $usDeshabilitado;
    }

    public function setMensajeOperacion($usMensajeOperacion) {
        $this->usMensajeOperacion = $usMensajeOperacion;
    }

    public function setear($usNombre, $usPass, $usMail, $usDeshabilitado = "") {
        $this->setUsNombre($usNombre);
        $this->setUsPass($usPass);
        $this->setUsMail($usMail);
        $this->setUsDeshabilitado($usDeshabilitado);
    }

    public function cargar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM 'usuario' WHERE idUsuario" . $this->getIdUsuario();
        if($base->iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res > 0) {
                $row = $base->Registro();
                $this->setear(
                    $row['id_usuario'],
                    $row['usuario_nombre'],
                    $row['usario_pass'],
                    $row['usuario_email'],
                    $row['usuario_deshabilitado']
                );
            }
        } else {
            $this->setMensajeOperacion("Tabla->listar:" . $base->getError());
        }
        return $resp;
    }

    public function modificar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE FROM 'usuario' WHERE id_usuario = " . $this->getIdUsuario(). "";
        if($base->Iniciar()) {
            if($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Usuario->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Usuario->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE id_usuario = " . $this->getIdUsuario() . "";
        if ($base->Iniciar()) {
            if($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeOperacion("Usuario->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("Usuario->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > 0) {
            while ($row = $base->Registro()) {
                $objUsuario = new usuario();
                $objUsuario->setear(
                    $row['usuario_nombre'],
                    $row['usuario_pass'],
                    $row['usuario_email'],
                    $row['usuario_deshabilitado']
                );
                array_push($arreglo, $objUsuario);
            }
        }else {
            $this->setMensajeOperacion("Tabla->listar: " . $base->getError());
        }
        return $arreglo;
    } 

    public function insertar() {
        $res = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuario (usnombre, uspass, usmail, usdeshabilitado) VALUES ('" . $this->getUsNombre() . "','" . $this->getUsPass() . "','" . $this->getUsMail() . "','" . $this->getUsDeshabilitado() . "')";
        if ($base->Iniciar()) {
            if($id = $base->Ejecutar($sql)) {
                $this->setIdUsuario($id);
                $res = true;
            } else {
                $this->setMensajeOperacion("Usuario->insertar: " . $base->getError());
            }
        } else {
            $this->SetMensajeOperacion("Usuario->insertar: " . $base->getError());
        }
        return $res;
    }
}