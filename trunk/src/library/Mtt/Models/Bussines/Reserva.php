<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Reserva
        extends Mtt_Models_Table_Reserva
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
        

    public function getReservaByEquipUser( $idUsuario, $idEquipo, $tipoReserva )
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
                ->joinInner( 'equipo', 
                        'reserva.equipo_id = equipo.id' , 
                        array ('nombre',
                            'precio' => 'precioventa',
                            'modelo',
                            'tag'
                            )
                )
                ->where( 'reserva.usuario_id = ?' , $idUsuario )
                ->where( 'reserva.equipo_id = ?' , $idEquipo )
                ->where( 'tipo_reserva_id = ?' , $tipoReserva)
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }        


    public function getReservaByUser( $idUsuario, $tipoReserva )
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
                ->joinInner( 'equipo', 
                        'reserva.equipo_id = equipo.id' , 
                        array ('equipo' => 'nombre',
                            'precio' => 'precioventa',
                            'modelo',
                            'tag',
                            'categoria_id'
                            )
                )
                ->joinInner( 'categoria', 
                        'categoria.id = equipo.categoria_id', 
                        array ('categoria' => 'categoria.nombre'
                            )
                )
                ->where( 'reserva.usuario_id = ?' , $idUsuario )
                ->where( 'tipo_reserva_id = ?' , $tipoReserva)
                ->where( 'reserva.active = ?' , self::ACTIVE )                
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }             
    
    public function countReservaByUserTipo( $idUsuario, $idTipoReserva )
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
                ->joinInner( 'equipo', 
                        'reserva.equipo_id = equipo.id' , 
                        array ('nombre',
                            'precio' => 'precioventa',
                            'modelo',
                            'tag'
                            )
                )
                ->where( 'reserva.usuario_id = ?' , $idUsuario )
                ->where( 'tipo_reserva_id = ?' , $tipoReserva)
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }        
        
        
        
    public function updateReserva( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveReserva( array $data )
        {

        $this->insert( $data );
        }


    public function deleteReserva( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarReserva( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarReserva( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }
