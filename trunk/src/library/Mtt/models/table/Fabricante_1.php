<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 */
class Mtt_Models_Table_Fabricante extends Zend_Db_Table_Abstract
    {

    protected $_name = 'fabricante';

    public function getComboValues()
        {
        $filas = $this->fetchAll( 'activo=1' )->toArray();
        $values = array( );
        foreach ( $filas as $fila )
            {
            $values[$fila['id']] = $fila['nombre'];
            }
        return $values;
        }

    public function detalle( $id )
        {
        $sql = "SELECT id, nombre, ruc, activo FROM fabricante WHERE id = " . $id;
        //$sql = sprintf("SELECT id, nombre, ruc, activo FROM fabricante WHERE id = %d ",$id);
        //$this->fetchRow(array('id=?'=>$id));

        return $this->getAdapter()->fetchRow( $sql );
        }

    }
