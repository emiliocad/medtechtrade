<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Table_Categoria extends Zend_Db_Table_Abstract
    {

    protected $_name = 'categoria';

    public function listar()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , '1' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }

   
    }
