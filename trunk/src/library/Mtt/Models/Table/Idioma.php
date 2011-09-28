<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_Idioma
        extends Mtt_Db_Table_Abstract
    {

    protected $_name = 'idiomas';
    protected $_primary = 'id';
    
    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        }

    }
