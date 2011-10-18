<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_IpLigence
        extends Mtt_Models_Table_IpLigence
    {


    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        }


    /**
     *
     * @param type $ipLong 
     */
    public  function getCountry( $ipLong )
        {
        $bd = $this->getAdapter();
        $query = $bd->select()
                ->from(
                        $this->_name ,
                        array(
                    'country_code' ,
                    'country_name' )
                )
                ->where( 'ip_from <= ?' , $ipLong )
                ->where( 'ip_to >= ?' , $ipLong )
                ->limit( 1 )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    }
