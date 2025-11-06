<?php

include_once '../MODELO/Rol.php';

class AbmRol
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;

        if (array_key_exists('idrol', $param) && array_key_exists('rodescripcion', $param)) {
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['rodescripcion']);
        }
        return $obj;
    }
    /**
     * Espera como parametro un arreglo asociativo donde las claves 
     * coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setear($param['idrol'], null);
        }
        return $obj;
    }
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function chequearCampo($parametro){
        $resp = false;
        if (isset($parametro)) {
            $resp = true;
        }
        return $resp;
    }
    /**
     * Permite dar de alta un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $objRol = $this->cargarObjeto($param);
        if ($objRol != null and $objRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }
    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($parametro){
        $respuesta = false;
        if ($this->chequearCampo($parametro)) {
            $objRol = $this->cargarObjetoConClave($parametro);
            if ($objRol != null && $objRol->eliminar()) {
                $respuesta = true;
            }
        }
        return $respuesta;
    }

    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($parametro){
        $resp = false;
        if ($this->chequearCampo($parametro)) {
            $obj = $this->cargarObjeto($parametro);
            if ($obj != null && $obj->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($parametro){
        $where = " true ";
        if ($parametro != null) {
            if (isset($parametro['idrol'])) {
                $where .= " and idrol = " . $parametro['idrol'];
            }
            if (isset($parametro['rodescripcion'])) {
                $where .= " and rodescripcion = '" . $parametro['rodescripcion'] . "'";
            }
        }
        $arreglo = Rol::listar($where);
        return $arreglo;
    }


}