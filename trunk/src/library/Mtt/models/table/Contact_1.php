<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 */
class Mtt_Models_Table_Contact extends Zend_Db_Table_Abstract
    {

    protected $_name = 'contact';

    public function listar()
        {
        
        }

    public function listarPorPais()
        {
        
        }

    public function getComboValues()
        {
        $_categoria = new Application_Model_Categoria();
        $categorias = $_categoria->fetchAll( 'activo=1' );
        $listado = array( );
        foreach ( $categorias as $categoria )
            {
            $productos = $_categoria->listarProductos( $categoria['id'] );
            $productos2 = array( );
            foreach ( $productos as $producto )
                {
                $productos2[$producto['id']] = $producto['nombre'];
                }
            if ( count( $productos ) )
                {
                $listado[$categoria['nombre']] = $productos2;
                }
            }
        return $listado;
        }

    public function getComboValidValues()
        {
        $_categoria = new Application_Model_Categoria();
        $categorias = $_categoria->fetchAll( 'activo=1' );
        $listado = array( );
        foreach ( $categorias as $categoria )
            {
            $productos = $_categoria->listarProductos( $categoria['id'] );
            $productos2 = array( );
            foreach ( $productos as $producto )
                {
                $productos2[] = $producto['id'];
                }
            if ( count( $productos ) )
                {
                foreach ( $productos2 as $productoId )
                    {
                    $listado[] = $productoId;
                    }
                }
            }
        return $listado;
        }

    public function getDetalles( Array $producto_ids )
        {
        
        }

    public function getDetalle( $producto_id )
        {
        
        }

    }
