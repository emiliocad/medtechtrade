<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Alerta
        extends Mtt_Models_Table_Alerta
    {


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


    public function getAlertaByUser( $idUser )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->where( 'usuario_id = ?' , $idUser )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }
        
        
    public function updateAlerta( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveAlerta( array $data )
        {

        $this->insert( $data );
        }


    public function deleteAlerta( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarAlerta( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarAlerta( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }
