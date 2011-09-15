<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Equipo
        extends Mtt_Models_Table_Equipo
    {


//TODO reparar este codigo
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


    public function getProduct( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array( 'id' , 'nombre' , 'precioventa' ,
                    'preciocompra' , 'tag' , 'calidad' ,
                    'cantidad' , 'modelo' , 'fechafabricacion' ,
                    'documento' , 'sourceDocumento' , 'pesoEstimado' , 'size' ,
                    'ancho' , 'alto' , 'sizeCaja' )
                )
                ->joinInner( 'categoria' ,
                             'categoria.id = equipo.categoria_id' ,
                             array(
                    'categoria.nombre as categoria' ,
                    'categoria.id as categoria_id'
                        )
                )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinInner( 'publicacionequipo' ,
                             'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                             array( 'publicacionequipo.nombre as publicacionequipo' ) )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' ) )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' ) )
                ->joinInner( 'paises' , 'paises.id = equipo.paises_id' ,
                             array( 'paises.nombre as pais' ) )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->query();

        return $query->fetchObject();
        }


    public function getImagenes( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name , array( 'id' , 'nombre' ) )
                ->joinInner( 'categoria' , 'categoria.id = ' . $id ,
                             array( 'categoria.nombre as categoria' ) )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imagen' ) )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function getImage( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name , array( 'id' , 'nombre' ) )
                ->joinInner( 'categoria' , 'categoria.id = ' . $id ,
                             array( 'categoria.nombre as categoria' ) )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imagen' ) )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
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


    public function listEquip()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'id' ,
                    'nombre as equipo' ,
                    'precioventa' ,
                    'preciocompra' ,
                    'calidad' ,
                    'modelo' ,
                    'fechafabricacion' ,
                    'documento' ,
                    'sourceDocumento' ,
                    'pesoEstimado' ,
                    'size' ,
                    'ancho' ,
                    'alto' ,
                    'sizeCaja' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner(
                        'publicacionEquipo' ,
                        'publicacionEquipo.id = equipo.publicacionEquipo_id' ,
                        array( 'publicacionEquipo.nombre as publicacionEquipo' )
                )
                ->joinInner( 'usuario' , 'usuario.id = equipo.usuario_id' ,
                             array( 'usuario.nombre as usuario' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.usuario_id' ,
                             array( 'usuario.login as usuario' )
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' )
                )
                ->joinInner( 'paises' ,
                             'paises.id = equipo.paises_id'
                        , array( 'paises.nombre as paises' ) )
                ->where( 'equipo.active = ?' , '1' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function listEquipbyUser( $userId )
        {
        $db = $this->getAdapter();

        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , '1' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function updateEquipo( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveEquipo( array $data )
        {

        $this->insert( $data );
        }


    public function deleteEquipo( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarEquipo( $id )
        {

        $this->update( array(
            "active" => self::ACTIVE )
                , 'id = ' . $id );
        }


    public function desactivarEquipo( $id )
        {

        $this->update( array(
            "active" => self::DESACTIVATE )
                , 'id = ' . $id );
        }


    public function updateView( $id )
        {
        $equipo = $this->getFindId( $id );
        $equipo = $equipo->toArray();
        $newView = ( int ) $equipo['views'] + 1;
        $data = array( 'views' => $newView );

        $this->update( $data , 'id = ' . $id );
        }


    }
