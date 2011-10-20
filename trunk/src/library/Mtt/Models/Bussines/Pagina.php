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


    /**
     * 
     */
    public function listPagina()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array(
                    'id' => 'idpagina' ,
                    'pagina' => 'nombre' ,
                    'active'
                        )
                )
                ->joinInner( 'idiomas' , 'idiomas.id = pagina.idiomas_id' ,
                             array(
                    'idioma' => 'idiomas.nombre'
                        )
                )
                ->joinInner( 'paises' , 'paises.id = pagina.paises_id' ,
                             array(
                    'pais' => 'paises.nombre'
                        )
                )
                ->where( 'pagina.active = ?' , self::ACTIVE )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    }