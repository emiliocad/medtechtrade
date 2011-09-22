<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Catalog_Equipo
        extends Mtt_Models_Bussines_Equipo
    {


    public function __construct()
        {
        parent::__construct();
        }


    /**
     * Metodo usado para la parte de Paginacion de 
     * Equipos
     * 
     * @author Luis Alberto Mayta Mamani
     * @method showEquipos
     * @return devuelve todos los items de la tabla 
     * productos convertidos en objects
     * 
     */
    public function showEquipos()
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfig.ini' , 'paginator'
        );
        $data = $_conf->toArray();
        $object = Zend_Paginator::factory( $this->getProducts() );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }


    public function showEquiposOfers()
        {
        return $this->getProductsOfersAll();
        }


    public function showEquiposOfersByCategory( $category_id )
        {
        return $this->getProductsOfersAllByCategory( $category_id );
        }


    }
