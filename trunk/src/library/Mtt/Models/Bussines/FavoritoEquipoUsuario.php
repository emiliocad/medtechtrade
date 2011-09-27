<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_FavoritoEquipoUsuario
        extends Mtt_Models_Table_FavoritoEquipoUsuario
    {

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
                ->order( 'fechagrabacion desc')
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function getByEquipoUser( $idUsuario, $idEquipo )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                        'id' ,
                        'equipo_id' ,
                        'usuario_id' ,
                        'fechagrabacion' ,
                        'order' ,
                        'active' 
                        )
                )
                ->where( 'equipo_id = ?' , $idEquipo )
                ->where( 'usuario_id = ?' , $idUsuario )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }
        
        
    public function updateFavoritoEquipoUsuario( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveFavoritoEquipoUsuario( array $data )
        {

        $this->insert( $data );
        }


    public function deleteFavoritoEquipoUsuario( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarFavoritoEquipoUsuario( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarFavoritoEquipoUsuario( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }
