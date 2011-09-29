<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_Pagina
        extends Mtt_Db_Table_Abstract
    {

    protected $_name = 'pagina';
    protected $_primary = 'idpagina';


    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        }


    }