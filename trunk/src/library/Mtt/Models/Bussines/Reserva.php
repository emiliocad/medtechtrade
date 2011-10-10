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
                        array (
                            'equipo' => 'nombre',
                            'precio' => 'precioventa',
                            'slug',
                            'modelo',
                            'tag',
                            'categoria_id',
                            'calidad'
                        )
                )
                ->joinInner( 'categoria', 
                        'categoria.id = equipo.categoria_id', 
                        array (
                            'categoria' => 'categoria.nombre'
                        )
                )
                ->joinInner( 'estadoequipo' ,     
                        'estadoequipo.id = equipo.estadoequipo_id' ,
                        array( 'estadoequipo.nombre as estadoequipo' ) 
                )
                ->joinInner( 
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array( 
                            'publicacionequipo.nombre as publicacionequipo' 
                        ) 
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' ) 
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' ) 
                )
                ->joinInner( 'paises' , 'paises.id = equipo.paises_id' ,
                             array( 'paises.nombre as pais' ) 
                )
                ->joinLeft( 'imagen' , 
                        'reserva.equipo_id = imagen.equipo_id' ,
                        array( 'imagen.descripcion',
                            'imagen.imagen', 
                            'imageNombre' => 'imagen.nombre' ) 
                )
                ->where( 'reserva.usuario_id = ?' , $idUsuario )
                ->where( 'tipo_reserva_id = ?' , $tipoReserva)
                ->where( 'reserva.active = ?' , self::ACTIVE )    
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }             
    
        

    public function getReservaByType( $tipoReserva )
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
                        array (
                            'equipo' => 'nombre',
                            'precio' => 'precioventa',
                            'modelo',
                            'tag',
                            'categoria_id',
                            'calidad'
                        )
                )
                ->joinInner( 'categoria', 
                        'categoria.id = equipo.categoria_id', 
                        array (
                            'categoria' => 'categoria.nombre'
                        )
                )
                ->joinInner( 'estadoequipo' ,     
                        'estadoequipo.id = equipo.estadoequipo_id' ,
                        array( 'estadoequipo.nombre as estadoequipo' ) 
                )
                ->joinInner( 
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array( 
                            'publicacionequipo.nombre as publicacionequipo' 
                        ) 
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' ) 
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' ) 
                )
                ->joinInner( 'paises' , 'paises.id = equipo.paises_id' ,
                             array( 'paises.nombre as pais' ) 
                )
                ->joinLeft( 'imagen' , 
                        'reserva.equipo_id = imagen.equipo_id' ,
                        array( 'imagen.descripcion',
                            'imagen.imagen', 
                            'imageNombre' => 'imagen.nombre' ) 
                )
                ->where( 'tipo_reserva_id = ?' , $tipoReserva)
                ->where( 'reserva.active = ?' , self::ACTIVE )    
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }             
            
        
        
        
    public function countReservaByUserTipo( $idUsuario, $idTipoReserva )
        {


        }      
        
        
        

    public function pagListFavoritosByUser( $idUser, $tipo )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini' , 'favoritos'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory( 
                $this->getReservaByUser( $idUser, $tipo) );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }        
        
 /**
     * 
     * 
     */
    public function listEquipMoreReserved( $limit, $tipoReserva )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                        'equipo_id' ,
                        'cantidad' => 'COUNT(*)'
                        )
                )
                ->joinInner( 'equipo', 
                        'reserva.equipo_id = equipo.id' , 
                        array ('equipo' => 'nombre' )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->where( 'reserva.active = ?' , self::ACTIVE )
                ->where( 'reserva.tipo_reserva_id = ?' , $tipoReserva )
                ->group( 'equipo_id')
                ->order( 'cantidad DESC' )
                ->limit( $limit )
                
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
