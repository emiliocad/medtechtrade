<?php

class Admin_CategoriaController extends Mtt_Controller_Action
    {

    protected $_categoria;

    public function init()
        {
        parent::init();
        $this->_categoria = new Mtt_Models_Bussines_Categoria();
        }

    public function indexAction()
        {
        
        }

    public function paginadoAction()
        {
        
        }

    public function registrarAction()
        {
        $form = new Mtt_Form_Categoria();
        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $categoria = $form->getValues();

            $this->_categoria->insert( $categoria );

            $this->_helper->FlashMessenger( 'Se Registro La Categoria' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_categoria->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    }

