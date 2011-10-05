<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_Categoria
        extends Mtt_Db_Table_Abstract
    {

    protected $_name = 'categoria';
    protected $_primary = 'id';


    public function __construct()
        {
        parent::__construct();
        }


    public function listar()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    }
