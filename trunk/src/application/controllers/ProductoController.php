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
        $id = $this->_getParam( 'id' , null );
        $this->view->id = $id;
        $this->view->u = $this->_producto->fetchRow( 'id=' . $id )->toArray();
        }

    }

?>
