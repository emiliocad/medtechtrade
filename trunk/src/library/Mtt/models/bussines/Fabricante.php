<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Bussines_Fabricante 
    extends Mtt_Models_Table_Fabricante {

    public function getComboValues() {
        $filas = $this->fetchAll('active=1')->toArray();
        $values = array();
        foreach ($filas as $fila) {
            $values[$fila['id']] = $fila['nombre'];
        }
        return $values;
    }

//    public function getFindId( $id )
//        {
////        $db = $this->getAdapter();
////        $query = $db->select()
////                ->from( $this->_name )
////                ->where( 'id = ?' , $id )
////                ->where( 'active = ?' , '1' )
////                ->query()
////        ;
//        return $this->fetchRow( 'id = ' . $id );
//        }

    public function listar($active ) {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from($this->_name)
                ->where( 'active in (?)' , $active )
                ->query()
        ;

        return $query->fetchAll(Zend_Db::FETCH_OBJ);
    }

    
    public function pagListManufactur($active = null) {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigAdmin.ini'
                , 'fabricante'
        );
        $data = $_conf->toArray();

        $value = ($active == null) ? array(0,1) : 1;
        
        $object = Zend_Paginator::factory($this->listar($value));
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
    }

    public function updateFabricante(array $data, $id) {

        $this->update($data, 'id = ' . $id);
    }

    public function saveFabricante(array $data) {

        $this->insert($data);
    }

    public function deleteFabricante($id) {

        $this->delete('id =' . (int) $id);
    }

    public function activarFabricante($id) {

        $this->update(array("active" => self::ACTIVE), 'id = ' . $id);
    }

    public function desactivarFabricante($id) {

        $this->update(array("active" => self::DESACTIVATE), 'id = ' . $id);
    }

}
