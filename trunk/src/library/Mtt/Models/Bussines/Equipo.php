<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Bussines_Equipo
        extends Mtt_Models_Table_Equipo
    {


    public function __construct( $config = array( ) )
        {
        parent::__construct( $config );
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

        return $this->fetchRow( 'id = ' . $id );
        }


    public function getProducts()
        {

        $db = $this->getAdapter();

        $query = $db->select()
                ->from( $this->_name , array( 'id' , 'nombre' ) )
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
                ->query();

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    /**
     *
     * @return type Object
     */
    public function getProductsOfersAll()
        {

        $db = $this->getAdapter();

        $query = $db->select()
                ->from( $this->_name , array( 'id' , 'nombre' , 'topofers' ) )
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
                ->from( $this->_name , array( 'id' , 'nombre' , 'topofers' ) )
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
                ->where( 'equipo.active = ?' , '1' )
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
                    'equipo.id' ,
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
                ->where( 'equipo.active = ?' , '1' )
                ->where( 'equipo.publicacionEquipo_id = ?' , $status )
                ->where( 'equipo.usuario_id = ?' , $idUser )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
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
                ->where( 'equipo.active = ?' , '1' )
                ->limit($limit)
                ->order('views DESC')
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


   /**
     * 
     * 
     */
    public function listEquipMoreReserved( $limit )
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                        'nombre as equipo'  
                        )
                )
                ->join ( 'operacion_has_equipo' , 
                        'operacion_has_equipo.equipo_id = equipo.id' ,
                        array( 'operacion_has_equipo.cantidad as cantidad' )
                )
                ->where( 'operacion_has_equipo.operacion_id = ?' , '1' )
                ->where( 'equipo.active = ?' , '1' )
                ->limit($limit)
                ->order('cantidad DESC')
                ->query()
                
    
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }
 
 
   /**
     * 
     * 
     */
    public function listEquipFavoritos( $limit )
        {

     
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                        'equipo.id',
                        'nombre as equipo'   
                        )
                )
                ->join ( 'favorito_equipo_usuario' , 
                        'favorito_equipo_usuario.equipo_id = equipo.id' ,
                        array( 'COUNT(equipo.id) AS cantidad' )
                )
                
                ->where( 'equipo.active = ?' , '1' )
                ->where( 'favorito_equipo_usuario.active = ?' , '1' )
                ->group( 'equipo.id' )
                ->limit($limit)
                ->order('cantidad DESC')
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
