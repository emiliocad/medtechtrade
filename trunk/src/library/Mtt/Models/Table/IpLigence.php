<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_IpLigence
        extends Mtt_Db_Table_Abstract
    {
    
    
    protected $_name = 'ipligence';
    protected $_primary = 'id';

    
    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        }

    }
