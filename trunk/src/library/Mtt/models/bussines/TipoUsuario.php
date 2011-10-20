<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_TipoUsuario
        extends Mtt_Models_Table_TipoUsuario
    {

   
    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
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


    public function getFindId( $id )
        {
//        $db = $this->getAdapter();
//        $query = $db->select()
//                ->from( $this->_name )
//                ->where( 'id = ?' , $id )
//                ->where( 'active = ?' , '1' )
//                ->query()
//        ;
        return $this->fetchRow( 'id = ' . $id );
        }


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


    public function updateTipoUsuario( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveTipoUsuario( array $data )
        {

        $this->insert( $data );
        }


    public function deleteTipoUsuario( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarTipoUsuario( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarTipoUsuario( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }
