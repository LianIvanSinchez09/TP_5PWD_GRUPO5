<?php
class AbmUsuarioRol {
    /**
     * Funcion que espera un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     */
    private function cargarObjeto($param) {
        $objUsuarioRol = null;
        $objRol = null;
        $objUsuario = null;
        if (array_key_exists('id_rol', $param) && $param['id_rol'] != null) {
            $objRol = new Rol();
            $objRol->setIdRol($param['id_rol']);
            $objRol->cargar();
        }
        if (array_key_exists('id_usuario', $param) && $param['id_usuario'] !=null) {
            $objUsuario = new Rol();
            $objRol->setIdRol($param['id_rol']);
            $objRol->cargar();
        }
        $objUsuarioRol = new UsuarioRol();
        $objUsuarioRol->setear($objUsuario, $objRol);
        return $objUsuarioRol;
    }

    /**
     * Funcion que espera un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     */
    private function cargarObjetoConClaves($param) {
        $objUsuarioRol = null;
        if(isset($param['id_usuario']) && isset($param['id_rol'])) {
            $objUsuarioRol = new UsuarioRol();
            $objUsuarioRol->setear($objUsuario, $objRol);
        }
        return $objUsuarioRol;
    }

    /**
     * Funcion que corrobora que dentro del arreglo asociativo esten seteados los campos claves
     */
    private function seteadosCamposClaves($param) {
        $resp = false;
        if(isset($param['id_usuario']) && isset($param['id_rol'])) {
            $resp = true;
        };
        
        return $resp;
    }

    /**
     * Funcion que permite dar de alta
     */
    public function alta($param) {
        $resp = false;
        $objUsuarioRol = $this->cargarObjeto($param);
        if($objUsuarioRol != null && $objUsuarioRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Funcion que permite eliminar un objeto
     */
    public function baja($param) {
        $resp = false;
        if($this->seteadosCamposClaves($param)) {
            $objUsuarioRol = $this->cargarObjeto($param);
            if ($objUsuarioRol != null && $objUsuarioRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Funcion que permite modificar un objeto
     */
    public function modificacion($param) {
        $resp = false;
        if($this->seteadosCamposClaves($param)) {
            $objUsuarioRol = $this->cargarObjeto($param);
            if($objUsuarioRol != null && $objUsuarioRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Funcion que permite buscar un objeto
     */
    public function buscar($param) {
        $where = "true";
        if($param != null) {
            if(isset($param['id_usuario'])) {
                $where .= "and id_usuario =" . $param['id_usuario'] . "";
            }
            if(isset($param['id_rol'])) {
                $where .= "and id_rol =" . $param['id_rol'] . "";
            }
        }
        $arreglo = UsuarioRol::listar($where,"");
        return $arreglo;
    }
}