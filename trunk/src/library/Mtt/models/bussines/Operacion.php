<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Venta
 *
 */
class Mtt_Models_Bussines_Operacion extends Mtt_Models_Table_Operacion
    {

    public function listarUltimasUsandoCache( $n )
        {
        $cache = Zend_Registry::get( 'cache' );
        $cacheId = 'ultimas_ventas';
        if ( $cache->test( $cacheId ) )
            {
            return $cache->load( $cacheId );
            }

        $resultado = $this->listarUltimas( $n );
        $cache->save( $resultado , $cacheId , array( ) , 20 );
        return $resultado;
        }

    public function listarUltimas( $n )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name , array(
                    'id_venta' => 'id' ,
                    'comentarios' ,
                    'fechahora'
                        )
                )
                ->join(
                        'venta_detalle' , 'venta.id=venta_detalle.id_venta' , array(
                    'total_venta' => 'sum(precio_venta*cantidad)' ,
                    'n_productos' => 'count(venta_detalle.id)'
                        )
                )
                ->group( 'venta_detalle.id_venta' )
                ->limit( $n );

        return $db->fetchAll( $query );
        }

    public function addVentaDetalle( $venta_detalle )
        {
        $S = new Zend_Session_Namespace( 'ventas' );
        if ( !isset( $S->venta->detalles ) )
            {
            $S->venta->detalles = array( );
            }
        $S->venta->detalles[] = $venta_detalle;
        }

    public function getVentaDetalles()
        {
        $S = new Zend_Session_Namespace( 'ventas' );
        return isset( $S->venta->detalles ) ? $S->venta->detalles : array( );
        }

    public function clearVentaDetalles()
        {
        $S = new Zend_Session_Namespace( 'ventas' );
        $S->venta->detalles = array( );
        }

    public function getDetallesVentaActual()
        {

        $detallesVenta = $this->getVentaDetalles();
        $datalles_ids = array( );
        foreach ( $detallesVenta as $d )
            {
            $datalles_ids[] = $d['id_producto'];
            }
        $_producto = new Application_Model_Producto();

        if ( count( $datalles_ids ) )
            {
            $detallesProducto = $_producto->getDetalles( $datalles_ids );
            } else
            {
            $detallesProducto = array( );
            }

        $detallesProducto_porId = array( );

        foreach ( $detallesProducto as $p )
            {
            $detallesProducto_porId[$p['id_producto']] = $p;
            }
        $detallesProducto = $detallesProducto_porId;

        foreach ( $detallesVenta as $k => $d )
            {
            $detallesVenta[$k] = $detallesVenta[$k] + $detallesProducto[$d['id_producto']];
            }

        return $detallesVenta;
        }

    public function addVenta( $venta )
        {
        $venta['fechahora'] = date( 'Y-m-d H:i:s' );
        $venta_id = $this->insert( $venta );
        $_venta_detalle = new Application_Model_VentaDetalle();
        $_producto = new Application_Model_Producto();
        //var_dump($this->getVentaDetalles());exit;
        foreach ( $this->getVentaDetalles() as $venta_detalle )
            {
            $producto = $_producto->fetchRow( 'id=' . $venta_detalle['id_producto'] );
            $venta_detalle['id_venta'] = $venta_id;
            $venta_detalle['precio_venta'] = $producto['precio'];
            $_venta_detalle->insert( $venta_detalle );
            }
        $this->clearVentaDetalles();
        }

    public function borrarDetalle( $i )
        {
        $S = new Zend_Session_Namespace( 'ventas' );
        $nuevo_detalle = array( );
        foreach ( $S->venta->detalles as $k => $detalle )
            {
            if ( $k != $i )
                {
                $nuevo_detalle[] = $detalle;
                }
            }
        $S->venta->detalles = $nuevo_detalle;
        }

    public function verDetalle( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name , array( ) )
                ->join(
                        'venta_detalle' , 'venta.id=venta_detalle.id_venta' , array(
                    'precio_venta' ,
                    'cantidad' ,
                    'total_venta' => '(precio_venta*cantidad)'
                        )
                )
                ->join(
                        'producto' , 'producto.id = venta_detalle.id_producto' , array(
                    'producto' => 'nombre' ,
                    'precio_actual' => 'precio'
                        )
                )
                ->joinLeft(
                        'categoria' , 'categoria.id = producto.id_categoria' , array(
                    'categoria' => 'nombre'
                        )
                )
                ->joinLeft(
                        'fabricante' , 'fabricante.id = producto.id_fabricante' , array(
                    'fabricante' => 'nombre' ,
                    'ruc'
                        )
                )
                ->where( 'venta.id = ? ' , $id );
        return $db->fetchAll( $query );
        }

    }