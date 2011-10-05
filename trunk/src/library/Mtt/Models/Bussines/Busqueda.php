<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Bussines_Busqueda 
        extends Mtt_Models_Table_Busqueda 
    {


    public function listSearchByUserId( $idUsuario ) 
        {
        
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'palabras_busqueda' ,
                    'modelo' ,
                    'fabricante' ,
                    'categoria_id',
                    'anio_inicio', 
                    'anio_fin',
                    'precio_inicio',
                    'precio_fin',
                    'usuario_id',        
                    'active'
                        )
                )
                
                ->where( 'usuario_id = ?' , $idUser )
                ->query();
        
        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }
    
    
    
    
    public function updateBusqueda(array $data, $id) {

        $this->update($data, 'id = ' . $id);
    }

    public function saveBusqueda(array $data) {

        $this->insert($data);
    }

    public function deleteBusqueda($id) {

        $this->delete('id = ?', $id);
    }

    public function activarBusqueda($id) {

        $this->update(array("active" => self::ACTIVE), 'id = ' . $id);
    }

    public function desactivarBusqueda($id) {

        $this->update(array("active" => self::DESACTIVATE), 'id = ' . $id);
    }

}
