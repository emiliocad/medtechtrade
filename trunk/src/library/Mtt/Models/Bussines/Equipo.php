<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Equipo
        extends Mtt_Models_Table_Equipo
    {


    public function getEquipmentBySlug( $slug )
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


    public function listar()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     *
     * @param type $id 
     */
    public function addTopOfers( $id )
        {
        $data = array( 'topofers' => self::ACTIVE );
        $this->updateEquipo( $data , $id );
        }


    /**
     *
     * @param type $id 
     */
    public function quitTopOfers( $id )
        {
        $data = array( 'topofers' => self::DESACTIVATE );
        $this->updateEquipo( $data , $id );
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


    public function getProduct( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array( 'id' , 'nombre' , 'precioventa' ,
                    'preciocompra' , 'tag' , 'calidad' ,
                    'cantidad' , 'modelo' , 'fechafabricacion' ,
                    'documento' , 'sourceDocumento' , 'pesoEstimado' , 'size' ,
                    'ancho' , 'alto' , 'sizeCaja' , 'especificaciones' )
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
                             array( 'publicacionequipo.nombre as publicacionequipo' ,
                    'publicacionequipo.id as publicacionid' ) )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' ) )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' ) )
                ->joinInner( 'paises' , 'paises.id = equipo.paises_id' ,
                             array( 'paises.nombre as pais' ) )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->where( 'equipo.id IN (?)' , $id )
                ->query();

        return $query->fetchObject();
        }


    public function getImagenes( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name , array( 'id' , 'nombre' ) )
                ->joinInner( 'categoria' ,
                             'categoria.id = equipo.categoria_id' ,
                             array( 'categoria.nombre as categoria' ) )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imagen' ,
                    'imagen.imagen as imagenurl' ,
                    'imagen.descripcion' ) )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->where( 'equipo.id = ?' , $id )
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
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'id = ?' , $id )
                ->where( 'active = ?' , self::ACTIVE )
                ->query()
        ;
        return $query->fetchObject();
        //return $this->fetchRow( 'id = ' . $id );
        }


    public function getProducts()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name , array( 'id' , 'nombre' , 'slug' ) )
                ->joinInner( 'categoria' ,
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
                ->where( 'equipo.publicacionEquipo_id  = ?' ,
                         Mtt_Models_Table_PublicacionEquipo::Activada )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     *
     * @return type Object
     */
    public function getProductsOfersAll( $limit = 0 )
        {

        $db = $this->getAdapter();

        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'id' , 'nombre' , 'topofers' , 'slug'
                        )
                )
                ->joinInner( 'categoria' ,
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
                ->where( 'equipo.topofers IN (?)' , self::ACTIVE )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->limit( $limit )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     *
     * @param type $category_id
     * @return type object
     */
    public function getProductsOfersAllByCategory( $category_id )
        {

        $db = $this->getAdapter();

        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'id' ,
                    'nombre' ,
                    'topofers' ,
                    'slug' )
                )
                ->joinInner( 'categoria' ,
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
                ->where( 'equipo.topofers IN (?)' , self::ACTIVE )
                ->where( 'equipo.categoria_id IN (?)' , $category_id )
                ->where( 'equipo.active IN (?)' , self::ACTIVE )
                ->group( 'equipo.id' )
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
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
                    'sizeCaja' ,
                    'topofers' ,
                    'publishdate' ,
                    'active' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner(
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array( 'publicacionequipo.nombre as publicacionequipo' )
                )
                ->joinInner( 'usuario' , 'usuario.id = equipo.usuario_id' ,
                             array( 'usuario.nombre as usuario' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' )
                )
                ->joinInner( 'paises' ,
                             'paises.id = equipo.paises_id'
                        , array( 'paises.nombre as paises' ) )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imageNombre' ,
                    'imagen.thumb as imageThumb' ,
                    'imagen.imagen as image' )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     * 
     * 
     */
    public function listEquipByUserStatus( $idUser , $status )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'equipo.id' , 'nombre as equipo' , 'precioventa' ,
                    'preciocompra' , 'calidad' , 'modelo' ,
                    'fechafabricacion' , 'documento' , 'sourceDocumento' ,
                    'pesoEstimado' ,
                    'size' ,
                    'ancho' ,
                    'alto' ,
                    'sizeCaja' ,
                    'topofers' ,
                    'publishdate' ,
                    'active' ,
                    'slug' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner(
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array( 'publicacionequipo.nombre as publicacionequipo' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' )
                )
                ->joinInner( 'paises' ,
                             'paises.id = equipo.paises_id'
                        , array( 'paises.nombre as paises' ) )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imageNombre' ,
                    'imagen.thumb as imageThumb' ,
                    'imagen.imagen as image' )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->where( 'equipo.publicacionEquipo_id = ?' , $status )
                ->where( 'equipo.usuario_id = ?' , $idUser )
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function pagListEquipByUserStatus( $idUser , $status )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini' , 'paginator'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory(
                        $this->listEquipByUserStatus( $idUser , $status )
        );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }


    public function pagListEquipByUser( $idUser )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini' , 'paginator'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory( $this->listEquipByUser( $idUser ) );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }


    public function pagListEquip()
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigAdmin.ini' , 'equipo'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory( $this->listEquip() );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }


    public function pagListResultSearch( $keywords , $modelo , $fabricante ,
                                         $categoria , $anioInicial ,
                                         $anioFinal , $precioInicial ,
                                         $precioFinal )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigUser.ini' ,
                        'paginator'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory( $this->searchEquip( $keywords ,
                                                               $modelo ,
                                                               $fabricante ,
                                                               $categoria ,
                                                               $anioInicial ,
                                                               $anioFinal ,
                                                               $precioInicial ,
                                                               $precioFinal ) );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }


    public function listEquipByUser( $idUser )
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
                    'sizeCaja' ,
                    'topofers' ,
                    'publishdate' ,
                    'active' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner(
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array(
                    'publicacionequipo.nombre as publicacionequipo'
                        )
                )
                ->joinInner( 'usuario' , 'usuario.id = equipo.usuario_id' ,
                             array( 'usuario.nombre as usuario' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' )
                )
                ->joinInner( 'paises' ,
                             'paises.id = equipo.paises_id'
                        , array( 'paises.nombre as paises' ) )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imageNombre' ,
                    'imagen.thumb as imageThumb' ,
                    'imagen.imagen as image' )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->where( 'usuario.id = ?' , $idUser )
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function listEquipUnresolved()
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
                    'sizeCaja' ,
                    'topofers' ,
                    'publishdate' ,
                    'active' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner(
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array(
                    'publicacionequipo.nombre as publicacionequipo'
                        )
                )
                ->joinInner( 'usuario' , 'usuario.id = equipo.usuario_id' ,
                             array( 'usuario.nombre as usuario' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' )
                )
                ->joinInner( 'paises' ,
                             'paises.id = equipo.paises_id'
                        , array( 'paises.nombre as paises' ) )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imageNombre' ,
                    'imagen.thumb as imageThumb' ,
                    'imagen.imagen as image' )
                )
                ->where( 'equipo.publicacionEquipo_id = ?' ,
                         Mtt_Models_Bussines_PublicacionEquipo::Pendiente )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     * 
     * 
     */
    public function listEquipByStatus( $status )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'equipo.id' , 'nombre as equipo' , 'precioventa' ,
                    'preciocompra' , 'calidad' , 'modelo' ,
                    'fechafabricacion' , 'documento' , 'sourceDocumento' ,
                    'pesoEstimado' ,
                    'size' ,
                    'ancho' ,
                    'alto' ,
                    'sizeCaja' ,
                    'topofers' ,
                    'publishdate' ,
                    'active' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner(
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array( 'publicacionequipo.nombre as publicacionequipo' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' )
                )
                ->joinInner( 'paises' ,
                             'paises.id = equipo.paises_id'
                        , array( 'paises.nombre as paises' ) )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imageNombre' ,
                    'imagen.thumb as imageThumb' ,
                    'imagen.imagen as image' )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->where( 'equipo.publicacionEquipo_id = ?' , $status )
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     * 
     * 
     */
    public function listEquipByCategory( $idCategoria , $status )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'equipo.id' , 'nombre as equipo' , 'precioventa' ,
                    'preciocompra' , 'calidad' , 'modelo' ,
                    'fechafabricacion' , 'documento' , 'sourceDocumento' ,
                    'pesoEstimado' ,
                    'size' ,
                    'ancho' ,
                    'alto' ,
                    'sizeCaja' ,
                    'topofers' ,
                    'publishdate' ,
                    'active' ,
                    'slug' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner(
                        'publicacionequipo' ,
                        'publicacionequipo.id = equipo.publicacionEquipo_id' ,
                        array( 'publicacionequipo.nombre as publicacionequipo' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinInner( 'moneda' , 'moneda.id = equipo.moneda_id' ,
                             array( 'moneda.nombre as moneda' )
                )
                ->joinInner( 'paises' ,
                             'paises.id = equipo.paises_id'
                        , array( 'paises.nombre as paises' ) )
                ->joinInner( 'estadoequipo' ,
                             'estadoequipo.id = equipo.estadoequipo_id' ,
                             array( 'estadoequipo.nombre as estadoequipo' ) )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imageNombre' ,
                    'imagen.thumb as imageThumb' ,
                    'imagen.imagen as image' )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->where( 'equipo.categoria_id = ?' , $idCategoria )
                ->where( 'equipo.publicacionEquipo_id = ?' , $status )
                ->group( 'equipo.id' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function pagListEquipByCategory( $idCategoria , $status )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfig.ini' ,
                        'categoria_equipo'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory(
                        $this->listEquipByCategory( $idCategoria , $status )
        );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }


    /**
     * 
     * 
     */
    public function listEquipMoreVisited( $limit )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'nombre as equipo' ,
                    'views'
                        )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->limit( $limit )
                ->order( 'views DESC' )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     * 
     * 
     */
    public function listEquipSalesUser( $idUser )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'equipo.id' ,
                    'equipo.nombre as equipo' ,
                    'precioventa AS precio' ,
                    'active'
                        )
                )
                ->joinLeft( 'operacion_has_equipo' ,
                            'operacion_has_equipo.equipo_id = equipo.id' ,
                            array( 'SUM(operacion_has_equipo.cantidad) AS cantidad' )
                )
                ->join( 'operacion' ,
                        'operacion_has_equipo.operacion_id = operacion.id'
                )
                ->join( 'categoria' , 'equipo.categoria_id = categoria.id' ,
                        array( 'categoria.nombre AS categoria' )
                )
                ->join( 'estadoequipo' ,
                        'equipo.estadoequipo_id = estadoequipo.id' ,
                        array( 'estadoequipo.nombre AS estadoequipo' )
                )
                ->join( 'fabricantes' ,
                        'equipo.fabricantes_id = fabricantes.id' ,
                        array( 'fabricantes.nombre AS fabricante' )
                )
                ->join( 'moneda' , 'equipo.moneda_id = moneda.id' ,
                        array( 'moneda.nombre AS moneda' ,
                    'moneda.simbolo AS simbolomoneda' )
                )
                ->join( 'paises' , 'equipo.paises_id = paises.id' ,
                        array( 'paises.nombre AS pais' )
                )
                ->where( 'estadooperacion_id = ?' ,
                         Mtt_Models_Bussines_estadoOperacion::SALE )
                ->where( 'equipo.usuario_id = ?' , $idUser )
                ->group( 'equipo.id' )
                ->query()


        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     * 
     * 
     */
    public function listEquipNoSalesUser( $idUser )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'equipo.id' ,
                    'equipo.nombre as equipo' ,
                    'precioventa AS precio' ,
                    'active'
                        )
                )
                ->joinLeft( 'operacion_has_equipo' ,
                            'operacion_has_equipo.equipo_id = equipo.id' ,
                            array( '(equipo.cantidad - 
                            SUM(operacion_has_equipo.cantidad)) AS cantidad' )
                )
                ->join( 'operacion' ,
                        'operacion_has_equipo.operacion_id = operacion.id'
                )
                ->join( 'categoria' , 'equipo.categoria_id = categoria.id' ,
                        array( 'categoria.nombre AS categoria' )
                )
                ->join( 'estadoequipo' ,
                        'equipo.estadoequipo_id = estadoequipo.id' ,
                        array( 'estadoequipo.nombre AS estadoequipo' )
                )
                ->join( 'fabricantes' ,
                        'equipo.fabricantes_id = fabricantes.id' ,
                        array( 'fabricantes.nombre AS fabricante' )
                )
                ->join( 'moneda' , 'equipo.moneda_id = moneda.id' ,
                        array( 'moneda.nombre AS moneda' ,
                    'moneda.simbolo AS simbolomoneda' )
                )
                ->join( 'paises' , 'equipo.paises_id = paises.id' ,
                        array( 'paises.nombre AS pais' )
                )
                ->where( 'estadooperacion_id = ?' ,
                         Mtt_Models_Bussines_estadoOperacion::SALE )
                ->where( 'equipo.usuario_id = ?' , $idUser )
                ->group( 'equipo.id' )
                ->having( 'cantidad > 0' )
                ->query()


        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function searchEquip( $keywords , $modelo , $fabricante ,
                                 $categoria , $anioInicial , $anioFinal ,
                                 $precioInicial , $precioFinal )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'id' ,
                    'nombre as equipo' ,
                    'modelo' ,
                    'fechafabricacion' ,
                    'tag' ,
                    'slug' ,
                    'preciocompra' ,
                    'active' )
                )
                ->joinInner(
                        'categoria' , 'categoria.id = equipo.categoria_id' ,
                        array( 'categoria.nombre as categoria' )
                )
                ->joinInner( 'fabricantes' ,
                             'fabricantes.id = equipo.fabricantes_id' ,
                             array( 'fabricantes.nombre as fabricante' )
                )
                ->joinLeft( 'imagen' , 'imagen.equipo_id = equipo.id' ,
                            array( 'imagen.nombre as imageNombre' ,
                    'imagen.thumb as imageThumb' ,
                    'imagen.imagen as image' )
                )
                ->where( 'equipo.active = ?' , self::ACTIVE )
                ->where( "equipo.nombre LIKE '%$keywords%'" )
                ->where( "equipo.modelo LIKE '%$modelo%'" )
                ->where( 'equipo.publicacionEquipo_id = ?' ,
                         Mtt_Models_Table_PublicacionEquipo::Activada
                )
                ->where( 'CASE ? WHEN -1 
                    THEN equipo.categoria_id LIKE "%%" 
                    ELSE equipo.categoria_id = ? 
                    END' ,
                         $categoria )
                ->where( "DATE_FORMAT(equipo.fechafabricacion,'%Y')  > ? " ,
                         $anioInicial )
                ->where( "CASE ?
                    WHEN -1 
                    THEN DATE_FORMAT(equipo.fechafabricacion,'%Y') < 
                    (DATE_FORMAT(NOW(),'%Y')+1) 
                    ELSE DATE_FORMAT(equipo.fechafabricacion,'%Y') < ? 
                    END" ,
                         $anioFinal )
                ->where( 'equipo.preciocompra > ?' , $precioInicial )
                ->where( 'CASE ? 
                    WHEN -1
                    THEN equipo.preciocompra > -1
                    ELSE equipo.preciocompra < ? END' ,
                         $precioFinal )
                ->group( 'equipo.id' )
                ->query()

        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     * para enviar correo de autorizacion
     * @param array $data
     * @param string $subject
     */
    public function sendMailToRequest( array $data , $subject )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/mail.ini'
        );


        $confMail = $_conf->toArray();

        $config = array(
            'auth' => $confMail['auth'] ,
            'username' => $confMail['username'] ,
            'password' => $confMail['password'] ,
            'port' => $confMail['port'] );

        $mailTransport = new Zend_Mail_Transport_Smtp(
                        $confMail['smtp'] ,
                        $config
        );

        //Mtt_Html_Mail_Mailer::setDefaultFrom();
        Zend_Mail::setDefaultFrom(
                $confMail['username'] , $confMail['data']
        );
        Zend_Mail::setDefaultTransport( $mailTransport );
//        Zend_Mail::setDefaultFrom(
//                $confMail['username'] , $confMail['data']
//        );
        Zend_Mail::setDefaultReplyTo(
                $confMail['username'] , $confMail['data']
        );
        $m = new Mtt_Html_Mail_Mailer();
        $m->setSubject( $data['asunto'] );

        $m->addTo( $confMail['email'] );

        if ( $data['toemail'] == 1 )
            {
            $m->addTo( $data['email'] );
            }

        $m->setViewParam( 'usuario' , $data['nombre'] )
                ->setViewParam( 'organizacion' , $data['organizacion'] )
                ->setViewParam( 'direccion' , $data['direccion'] )
                ->setViewParam( 'codpostal' , $data['codpostal'] )
                ->setViewParam( 'ciudad' , $data['ciudad'] )
                ->setViewParam( 'pais' , $data['pais'] )
                ->setViewParam( 'mensaje' , $data['mensaje'] )
                ->setViewParam( 'equipo' , $data['equipo'] )

        ;

        $m->sendHtmlTemplate( "request.phtml" );
        }


    public function publicarEquipo( $id )
        {

        $this->update( array(
            "publicacionEquipo_id" =>
            Mtt_Models_Bussines_PublicacionEquipo::Activada )
                , 'id = ' . $id );
        }


    public function updateEquipo( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveEquipo( array $data )
        {

        $slug = new Mtt_Filter_Slug( array(
                    'field' => 'slug' ,
                    'model' => $this
                        ) );

        $data['usuario_id'] = $this->authData['usuario']->id;
        $data['publicacionEquipo_id'] = Mtt_Models_Table_PublicacionEquipo::Pendiente;
        $data['slug'] = $slug->filter( $data['nombre'] );

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
        //$equipo = $equipo->toArray();
        $newView = ( int ) $equipo->views + 1;
        $data = array( 'views' => $newView );

        $this->update( $data , 'id = ' . $id );
        }


    }
