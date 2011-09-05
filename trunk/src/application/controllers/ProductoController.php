<?php

class ProductoController extends Mtt_Controller_Action
    {

    public function init()
        {
        parent::init();
        $this->_producto = new Mtt_Models_Bussines_Producto();
        }

    public function indexAction()
        {
        
        }

    public function paginadoAction()
        {
        $p = $this->_producto->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );

        $this->view->assign( 'producto' , $this->_producto->getProduct( $id ) );
        }

    }

