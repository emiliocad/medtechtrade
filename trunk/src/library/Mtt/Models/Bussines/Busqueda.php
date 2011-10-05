<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Bussines_Busqueda 
    extends Mtt_Models_Table_Busqueda 
    {

    public function listSearchByUserId($idUsuario) 
        {

        $db = $this->getAdapter();
        $query = "SELECT id,
            palabras_busqueda,
            modelo,
            fabricante,
            categoria_id,
            CASE anio_inicio WHEN -1 THEN '' ELSE anio_inicio END AS anio_inicio,
            CASE anio_fin WHEN -1 THEN '' ELSE anio_fin END AS anio_fin,
            CASE precio_inicio WHEN -1 THEN '' ELSE precio_inicio END AS precio_inicio,
            CASE precio_fin WHEN -1 THEN '' ELSE precio_fin END precio_fin,
            usuario_id,
            CASE categoria_id 
                WHEN -1 THEN 'Todos' 
                ELSE (
                    SELECT nombre FROM categoria 
                    WHERE categoria.id = categoria_id
                ) END AS categoria
            FROM busqueda
            WHERE active = ".self::ACTIVE." and usuario_id = " . $idUsuario;

        return $db->query($query)->fetchAll(Zend_Db::FETCH_OBJ);
        
        }

        
    public function getFindId( $id )
        {
         return $this->fetchRow( 'id = ' . $id );
        }

        
        
    public function updateBusqueda(array $data, $id) 
        {

        $this->update($data, 'id = ' . $id);
        }

    public function saveBusqueda(array $data) 
        {

        $this->insert($data);
        }

    public function deleteBusqueda($id) 
        {

        $this->delete('id = ?', $id);
        }

    public function activarBusqueda($id) 
        {

        $this->update(array("active" => self::ACTIVE), 'id = ' . $id);
        }

    public function desactivarBusqueda($id) 
        {

        $this->update(array("active" => self::DESACTIVATE), 'id = ' . $id);
        
        }

}
