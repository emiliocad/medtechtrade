<?php

class Admin_ProductoController extends Mtt_Controller_Action
    {

    protected $_producto;

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
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function registrarAction()
        {
        $form = new Mtt_Form_Producto();
        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $producto = $form->getValues();

            $this->_producto->insert( $producto );

            $this->_helper->FlashMessenger( 'Se Registro La Categoria' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_producto->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    }

