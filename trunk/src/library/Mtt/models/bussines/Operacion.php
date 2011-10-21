<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Operacion
        extends Mtt_Models_Table_Operacion
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


    /**
     *
     * @param type $n
     * @return type 
     */
    public function listar()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'operacion.id' ,
                    'fecha' ,
                    'fechainicio' ,
                    'fechapago'
                        )
                )
                ->join(
                        'operacion_has_equipo' ,
                        'operacion.id = operacion_has_equipo.operacion_id' ,
                        array(
                    'precio' ,
                    'cantidad' ,
                    'nitems' => 'count(operacion_has_equipo.id)'
                        )
                )
                ->joinInner( 'estadooperacion' ,
                             'operacion.estadooperacion_id = estadooperacion.id' ,
                             array(
                    'estadooperacion' => 'nombre'
                        )
                )
                ->joinInner( 'usuario' , 'operacion.usuario_id = usuario.id' ,
                             array(
                    'usuario' => 'nombre'
                        )
                )
                ->group( 'operacion_has_equipo.operacion_id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function listByOperation( $status )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'operacion.id' ,
                    'fecha' ,
                    'fechainicio' ,
                    'fechapago',
                    'total'
                        )
                )
                ->joinInner(
                        'operacion_has_equipo' ,
                        'operacion.id = operacion_has_equipo.operacion_id' ,
                        array(
                    'precio' ,
                    'cantidad' => 'operacion_has_equipo.cantidad' ,
                    'equipo_id' => 'operacion_has_equipo.equipo_id',
                    'nequipos' => 'COUNT(operacion_has_equipo.id)'       
                        )
                )
                ->joinInner(
                        'estadooperacion' ,
                        'estadooperacion.id = operacion.estadooperacion_id' ,
                        array(
                    'estadooperacion' => 'estadooperacion.nombre'
                        )
                )
                ->joinInner(
                        'usuario' , 'usuario.id = operacion.usuario_id' ,
                        array(
                    'usuario' => 'usuario.login' ,
                    'usuario_id' => 'usuario.id',
                    'usuario_nombreCompleto' => 
                            'CONCAT(usuario.nombre, " ", usuario.apellido )',
                       
                        )
                )
                ->joinInner(
                        'equipo_has_formapago' ,
                        'operacion_has_equipo.equipo_has_formapago_id = 
                            equipo_has_formapago.id' ,
                        array(
                    'dias' ,
                    'moraxdia' ,
                    'nrocuotas' => 'equipo_has_formapago.nrocuotas' ,
                    'pago_forma' => 'equipo_has_formapago.pago' ,
                    'totalpago'
                        )
                )
                ->joinInner( 'formapago' ,
                             'equipo_has_formapago.formapago_id = formapago.id' ,
                             array( 'formapago' => 'formapago.nombre'
                        )
                )
                ->where( 'operacion.estadooperacion_id = ?' , $status )
                ->group( 'operacion.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     *
     * @param type $estado_operacion
     * @return type 
     */
    public function listByUserOperation( $idUser , $status )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'operacion.id' ,
                    'fecha' ,
                    'fechainicio' ,
                    'fechapago'
                        )
                )
                ->joinInner(
                        'operacion_has_equipo' ,
                        'operacion.id = operacion_has_equipo.operacion_id' ,
                        array(
                    'precio' ,
                    'cantidad' => 'operacion_has_equipo.cantidad' ,
                    'equipo_id' => 'operacion_has_equipo.equipo_id'
                        )
                )
                ->joinInner(
                        'equipo_has_formapago' ,
                        'operacion_has_equipo.equipo_has_formapago_id = 
                            equipo_has_formapago.id' ,
                        array(
                    'dias' ,
                    'moraxdia' ,
                    'nrocuotas' => 'equipo_has_formapago.nrocuotas' ,
                    'pago_forma' => 'equipo_has_formapago.pago' ,
                    'totalpago'
                        )
                )
                ->joinInner( 'formapago' ,
                             'equipo_has_formapago.formapago_id = formapago.id' ,
                             array( 'formapago' => 'formapago.nombre'
                        )
                )
                ->joinInner( 'equipo' ,
                             'operacion_has_equipo.equipo_id = equipo.id' ,
                             array( 'precio' => 'equipo.precioventa' ,
                    'nombre' ,
                    'modelo',
                    'slug'
                        )
                )
                ->joinInner( 'imagen' ,
                             'operacion_has_equipo.equipo_id = equipo.id' ,
                             array( 'imagen' )
                )
                ->where( 'operacion.estadooperacion_id = ?' , $status )
                ->where( 'operacion.usuario_id = ?' , $idUser )
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     *
     * @param type $estado_operacion
     * @return type 
     */
    public function listByUserSalesActive( $idUser , $status )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'operacion.id' ,
                    'fecha' ,
                    'fechainicio' ,
                    'fechapago'
                        )
                )
                ->joinInner(
                        'operacion_has_equipo' ,
                        'operacion.id = operacion_has_equipo.operacion_id' ,
                        array(
                    'precio' ,
                    'cantidad' => 'operacion_has_equipo.cantidad' ,
                    'equipo_id' => 'operacion_has_equipo.equipo_id'
                        )
                )
                ->joinInner(
                        'equipo_has_formapago' ,
                        'operacion_has_equipo.equipo_has_formapago_id = 
                            equipo_has_formapago.id' ,
                        array(
                    'dias' ,
                    'moraxdia' ,
                    'nrocuotas' => 'operacion_has_equipo.equipo_id' ,
                    'pago_forma' => 'equipo_has_formapago.pago' ,
                    'totalpago'
                            )
                )
                ->joinInner( 'formapago' ,
                             'equipo_has_formapago.formapago_id = formapago.id' ,
                             array( 'formapago' => 'formapago.nombre'
                        )
                )
                ->joinInner( 'equipo' ,
                             'operacion_has_equipo.equipo_id = equipo.id' ,
                             array( 'precio' => 'equipo.precioventa' ,
                    'nombre' ,
                    'modelo' ,
                    'slug'
                        )
                )
                ->joinInner( 'imagen' ,
                             'operacion_has_equipo.equipo_id = equipo.id' ,
                             array( 'imagen' )
                )
                ->where( 'operacion.estadooperacion_id = ?' , $status )
                ->where( 'operacion.usuario_id = ?' , $idUser )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function paglistByUserSalesActive( $idUser , $status )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini' ,
                        'compras-activas'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory(
                        $this->listByUserSalesActive( $idUser , $status ) );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }


    public function listByUser( $idUser )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'operacion.id' ,
                    'fecha' ,
                    'fechainicio' ,
                    'fechapago'
                        )
                )
                ->joinInner(
                        'operacion_has_equipo' ,
                        'operacion.id = operacion_has_equipo.operacion_id' ,
                        array(
                    'precio' ,
                    'cantidad' => 'operacion_has_equipo.cantidad' ,
                    'equipo_id' => 'operacion_has_equipo.equipo_id'
                        )
                )
                ->joinInner(
                        'equipo_has_formapago' ,
                        'operacion_has_equipo.equipo_has_formapago_id = 
                            equipo_has_formapago.id' ,
                        array(
                    'dias' ,
                    'moraxdia' ,
                    'nrocuotas' => 'operacion_has_equipo.equipo_id' ,
                    'pago_forma' => 'equipo_has_formapago.pago' ,
                    'totalpago'
                        )
                )
                ->joinInner( 'formapago' ,
                             'equipo_has_formapago.formapago_id = formapago.id' ,
                             array( 'formapago' => 'formapago.nombre'
                        )
                )
                ->joinInner( 'equipo' ,
                             'operacion_has_equipo.equipo_id = equipo.id' ,
                             array( 'precio' => 'equipo.precioventa' ,
                    'nombre' ,
                    'modelo' ,
                    'slug' )
                )
                ->joinLeft( 'imagen' ,
                            'operacion_has_equipo.equipo_id = equipo.id' ,
                            array( 'imagen' )
                )
                ->where( 'operacion.usuario_id = ?' , $idUser )
                ->group( 'equipo.id')
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }

        
    public function paglistByUser( $idUser  )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini' , 
                'compras-activas'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory(
                        $this->listByUser( $idUser ) );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }
        


    public function listarUltimas( $n )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'id_venta' => 'id' ,
                    'comentarios' ,
                    'fechahora'
                        )
                )
                ->join(
                        'venta_detalle' , 'venta.id=venta_detalle.id_venta' ,
                        array(
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


    public function saveOperacion( $data )
        {
        return $this->insert( $data );
        }


    public function verDetalle( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name , array( 'fecha' ) )
                ->join(
                        'operacion_has_equipo' ,
                        'operacion.id = operacion_has_equipo.operacion_id' ,
                        array(
                    'precio_op' => 'precio' ,
                    'cantidad_operacion' => 'operacion_has_equipo.cantidad' ,
                    'total_venta' => '(precio*operacion_has_equipo.cantidad)'
                        )
                )
                ->join(
                        'equipo' ,
                        'operacion_has_equipo.equipo_id = equipo.id' ,
                        array(
                    'equipo' => 'nombre' ,
                    'precio' => 'precioventa' ,
                    'modelo'
                        )
                )
                ->joinLeft(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array(
                    'categoria' => 'nombre'
                        )
                )
                ->joinLeft(
                        'fabricantes' ,
                        'fabricantes.id = equipo.fabricantes_id' ,
                        array(
                    'fabricante' => 'nombre'
                        )
                )
                ->where( 'operacion.id = ? ' , $id )
                ->query();

        return $query->fetchObject();
        }


    }
