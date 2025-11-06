<?php

include_once(__DIR__ . '/../MODELO/Usuario.php');


class AbmUsuario
{
    /**
     * Espera como parametro un arreglo asociativo donde 
     * las claves coinciden con los nombres de las variables instancias del objeto
     */
    private function cargarObjeto($parametro)
    {
        $usuario = null;

        $checkPropiedadesUsuario = array_key_exists('usnombre', $parametro) && array_key_exists('uspassword', $parametro) && array_key_exists('usmail', $parametro) && array_key_exists('usuario_deshabilitado', $parametro);

        if ($checkPropiedadesUsuario) {
            $usuario = new Usuario();
            $usuario->setear(
                $parametro['usnombre'],
                $parametro['uspassword'],
                $parametro['usmail'],
                $parametro['usuario_deshabilitado'],
            );
        }
        return $usuario;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves
     */
    private function cargarObjetoConClave($parametro)
    {
        $objUsuario = null;
        if (isset($parametro['idusuario'])) {
            $objUsuario = new Usuario();
            $objUsuario->setear($parametro['idusuario'], null, null, null, null);
        }
        return $objUsuario;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     */
    private function chequearCamposUsuario($parametro)
    {
        $resp = false;
        if (isset($parametro)) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Permite dar de alta un usuario
     */
    public function alta($parametro)
    {
        $respuesta = false;
        $objUsuario = $this->cargarObjeto($parametro);
        // if($objUsuario == null){
        //     print_r($parametro);
        //     return "Faltan datos para el alta del usuario";
        // }
        if ($objUsuario != null && verificarUsuario($objUsuario) == false) {
            // $respuesta = "Si se pudo dar de alta el usuario";
            $objUsuario->insertar();
            $respuesta = true;
        }
        return $respuesta;
    }

    /**
     * Permite eliminar un objeto
     */
    public function baja($parametro)
    {
        $respuesta = false;
        if ($this->chequearCamposUsuario($parametro)) {
            $objUsuario = $this->cargarObjetoConClave($parametro);
            if ($objUsuario != null && $objUsuario->eliminar()) {
                $respuesta = true;
            }
        }
        return $respuesta;
    }

    /**
     * Permite modificar un objeto
     */
    public function modificar($parametro)
    {
        $respuesta = false;
        if ($this->chequearCamposUsuario($parametro)) {
            $objUsuario = $this->buscar($parametro);
            $objUsuario = $this->cargarObjeto($parametro);
            if ($objUsuario != null && $objUsuario->modificar()) {
                $respuesta = true;
            }
        }
        return $respuesta;
    }

    /**
     * Permite buscar un objeto
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario = '" . $param['idusuario'] . "'";
            }

            if (isset($param['usnombre'])) {
                $where .= " and usnombre = '" . $param['usnombre'] . "'";
            }

            if (isset($param['uspass'])) {
                $where .= " and uspass ='" . $param['uspass'] . "'";
            }

            if (isset($param['usmail'])) {
                $where .= " and usmail = '" . $param['usmail'] . "'";
            }

            if (isset($param['usdeshabilitado'])) {
                $where .= " and usdeshabilitado = '" . $param['usdeshabilitado'] . "'";
            }
        }
        $usuario = new Usuario();
        $arreglo = $usuario->listar($where);
        
        return $arreglo;
    }
}