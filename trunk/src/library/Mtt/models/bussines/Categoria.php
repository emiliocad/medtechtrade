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


    public function getProducts( $id , $order = "modelo" )
        {
        $_producto = new Mtt_Models_Bussines_Equipo();
        $db = $this->getAdapter();

        $query = $db->select()
<<<<<<< HEAD
                ->from( 'equipo' , array( 'id' , 'nombre' ) )
=======
                ->from( 'equipo' , array( 'id' , 'nombre' , 'modelo' ) )
>>>>>>> developer
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
<<<<<<< HEAD
=======
                ->order( $order )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function getProductsSlug( $slug , $order = "modelo" )
        {
        $_producto = new Mtt_Models_Bussines_Equipo();
        $data = $this->getCategoriaBySlug( $slug );
        $db = $this->getAdapter();

        $query = $db->select()
                ->from( 'equipo' , array( 'id' , 'nombre' , 'modelo' ) )
                ->joinInner( $this->_name ,
                             'categoria.id = equipo.categoria_id ' ,
                             array(
                    'categoria' => 'nombre' ,
                    'slug' => 'slug'
                        )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imagen' )
                )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->where( 'equipo.categoria_id IN (?)' , $data->id )
                ->order( $order )
>>>>>>> developer
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


    public function listCategory()
        {

<<<<<<< HEAD
        
        $db = $this->getAdapter();

        $query = $db->select()
                ->from( $this->_name)
                ->where( 'active IN (?)' , self::ACTIVE )
 
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        
        }


       


=======
        $db = $this->getAdapter();

        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active IN (?)' , self::ACTIVE )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


>>>>>>> developer
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


<<<<<<< HEAD
=======
    public function getCategoriaBySlug( $slug )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'slug IN (?)' , $slug )
                ->where( 'active = ?' , self::ACTIVE )
                ->query()
        ;
        return $query->fetchObject();
        }


>>>>>>> developer
    public function updateCategoria( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveCategoria( array $data )
        {
<<<<<<< HEAD

=======
        $slug = new Mtt_Filter_Slug( array(
                    'field' => 'slug' ,
                    'model' => $this
                        ) );

        $dataNew = array(
            'slug' => $slug->filter( $data['title'] )
        );

        $data = array_merge( $dataNew , $data );
>>>>>>> developer
        $this->insert( $data );
        }


    public function deleteCategoria( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarCategoria( $id )
        {

        $this->update( array(
            "active" => self::ACTIVE )
                , 'id = ' . $id );
        }


    public function desactivarCategoria( $id )
        {

        $this->update( array(
            "active" => self::DESACTIVATE )
                , 'id = ' . $id );
        }


<<<<<<< HEAD

   

=======

>>>>>>> developer
    }
