<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Pagina
        extends Mtt_Models_Table_Pagina
    {


    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        }


    public function getFindId( $id )
        {
        return $this->fetchRow( 'id = ' . $id );
        }


    }