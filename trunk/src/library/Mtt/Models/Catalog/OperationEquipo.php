<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Catalog_OperationEquipo
        extends Mtt_Models_Bussines_OperationEquipo
    {

    protected $sessionMtt;


    public function __construct()
        {
        $this->sessionMtt = new Zend_Session_Namespace( 'Mtt' );
        parent::__construct();
        }


    public function getExistDetalle( $operacionDetalle )
        {


        if ( count( $this->sessionMtt->operacion->detalles ) > 0 )
            {
            for ( $index = 0;
                        $index < count( $this->sessionMtt->operacion->detalles );
                        $index++ )
                {
                if (
                        $this->sessionMtt->operacion->detalles[$index]->id
                        == $operacionDetalle->id
                )
                    {
                    return true;
                    }
                }
            return false;
            }
        return false;
        }


    public function addOperacionDetalle( $operacionDetalle )
        {
        if ( !isset( $this->sessionMtt->operacion->detalles ) )
            {
            $this->sessionMtt->operacion->detalles = array( );
            }
        else
            {

            if ( !$this->getExistDetalle( $operacionDetalle ) )
                {
                $this->sessionMtt->operacion->detalles[] = $operacionDetalle;
                }
            }
        }


    public function getOperacionDetalles()
        {

        return isset( $this->sessionMtt->operacion->detalles ) ?
                $this->sessionMtt->operacion->detalles : array( );
        }


    public function clearOperacionDetalles()
        {
        $this->sessionMtt->operacion->detalles = array( );
        }


    public function getDetallesOperacionActual()
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
            }
        else
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


    public function saveOperacionDetalle()
        {
        
        }


    public function addOperacion( $venta )
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
        $this->clearOperacionDetalles();
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
                        'venta_detalle' , 'venta.id=venta_detalle.id_venta' ,
                        array(
                    'precio_venta' ,
                    'cantidad' ,
                    'total_venta' => '(precio_venta*cantidad)'
                        )
                )
                ->join(
                        'producto' , 'producto.id = venta_detalle.id_producto' ,
                        array(
                    'producto' => 'nombre' ,
                    'precio_actual' => 'precio'
                        )
                )
                ->joinLeft(
                        'categoria' , 'categoria.id = producto.id_categoria' ,
                        array(
                    'categoria' => 'nombre'
                        )
                )
                ->joinLeft(
                        'fabricante' ,
                        'fabricante.id = producto.id_fabricante' ,
                        array(
                    'fabricante' => 'nombre' ,
                    'ruc'
                        )
                )
                ->where( 'venta.id = ? ' , $id );
        return $db->fetchAll( $query );
        }


    }

