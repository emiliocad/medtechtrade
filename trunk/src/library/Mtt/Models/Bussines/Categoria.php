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

    //Filtro publicado    
    public function getProducts( $id , $order = "modelo" )
        {
        $_producto = new Mtt_Models_Bussines_Equipo();
        $db = $this->getAdapter();

        $query = $db->select()
                ->from(
                        'equipo' ,
                        array(
                    'id' ,
                    'nombre' ,
                    'modelo' ,
                    'slug' )
                )
                ->joinInner( $this->_name ,
                             'categoria.id = equipo.categoria_id ' ,
                             array( 'categoria.nombre as categoria' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.imagen as imagen' )
                )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->where( 'equipo.categoria_id IN (?)' , $id )
                ->where( 'equipo.publicacionEquipo_id = ?' , 
                        Mtt_Models_Table_PublicacionEquipo::Activada
                )
                ->group( 'equipo.id' )
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


    public function listCategory( $active = null)
        {
        $value = ($active == null) ? array(0, 1) : 1;
        
        $db = $this->getAdapter();

        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active IN (?)' , $value )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }
        
        
        
    public function pagListCategory( $active = null) {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigAdmin.ini'
                        , 'categoria'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory($this->listCategory($active));
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
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


    public function updateCategoria( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveCategoria( array $data )
        {

        $slug = new Mtt_Filter_Slug( array(
                    'field' => 'slug' ,
                    'model' => $this
                        ) );

        $dataNew = array(
            'slug' => $slug->filter( $data['title'] )
        );

        $data = array_merge( $dataNew , $data );
        $this->insert( $data );
        }


    public function deleteCategoria( $id )
        {

        $this->delete('id =' . (int) $id);
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


    }
