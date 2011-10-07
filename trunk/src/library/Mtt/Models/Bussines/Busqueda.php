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
        
        
       
    public function setSearch( array $data )
        {
        //Definiendo variable search
        $search = new Zend_Session_Namespace( 'Search' );
        $search->PalabrasBusqueda = $data['palabras_busqueda'];
        $search->Modelo = $data['modelo'];
        $search->Fabricante = $data['fabricante'];
        $search->CategoriaId = $data['categoria_id'];     
        $search->AnioInicio = $data['anio_inicio']; 
        $search->AnioFin = $data['anio_fin']; 
        $search->PrecioInicio = $data['precio_inicio']; 
        $search->PrecioFin = $data['precio_fin']; 
                                       
        }
        

        
       
    public function getSearch(  )
        {
        //Definiendo variable search
        $search = new Zend_Session_Namespace( 'Search' );
        return $search;
                         
                     
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
