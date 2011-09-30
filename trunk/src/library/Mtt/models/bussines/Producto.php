<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Bussines_Producto
        extends Mtt_Models_Table_Producto
    {


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
                             array( 'categoria.nombre as categoria' ) )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinInner( 'publicacionEquipo' ,
                             'publicacionEquipo.id = equipo.publicacionEquipo_id' ,
                             array( 'publicacionEquipo.nombre as publicacionequipo' ) )
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


    }