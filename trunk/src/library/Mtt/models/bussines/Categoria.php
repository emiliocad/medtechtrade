<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Categoria
 *
 */
class Mtt_Models_Bussines_Categoria
        extends Mtt_Models_Table_Categoria
    {


    public function __construct()
        {
        parent::__construct();
        }


    public function getProducts( $id )
        {
        $_producto = new Mtt_Models_Bussines_Equipo();
        $db = $this->getAdapter();

        $query = $db->select()
                ->from( 'equipo' , array( 'id' , 'nombre' ) )
                ->joinInner( $this->_name ,
                             'categoria.id = equipo.categoria_id ' ,
                             array( 'categoria.nombre as categoria' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imagen' )
                )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->where( 'equipo.categoria_id IN (?)' , $id )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function getComboValues()
        {
        $filas = $this->fetchAll( 'active=1' )->toArray();
        $values = array( );
        foreach ( $filas as $fila )
            {
            $values[$fila['id']] = $fila['nombre'];
            }
        return $values;
        }


    public function getCategoria( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'id IN (?)' , $id )
                ->where( 'active = ?' , '1' )
                ->query()
        ;
        return $query->fetchObject();
        }


   


    }
