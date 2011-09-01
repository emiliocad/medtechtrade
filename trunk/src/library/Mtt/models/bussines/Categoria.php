<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 */
class Mtt_Models_Bussines_Categoria extends Mtt_Models_Table_Categoria
    {

    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
        }

    public function listarProductos( $id )
        {
        $_producto = new Mtt_Models_Bussines_Producto();
        
        $productos = $_producto->fetchAll( "id_categoria=$id AND activo=1" );
        
        return $productos->toArray();
        }

    public function getComboValues()
        {
        $filas = $this->fetchAll( 'activo=1' )->toArray();
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
