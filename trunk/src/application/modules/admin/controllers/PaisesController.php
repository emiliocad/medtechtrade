<?php

class Admin_PaisesController extends Mtt_Controller_Action
    {

    protected $_pais;

    public function init()
        {
        parent::init();
        $this->_pais = new Mtt_Models_Bussines_Paises();
        }

    public function indexAction()
        {
        
        }

    
    public function registrarAction()
        {
        $form = new Mtt_Form_Equipo();
        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $producto = $form->getValues();

            $this->_pais->insert( $producto );

            $this->_helper->FlashMessenger( 'Se Registro La Categoria' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_pais->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    }

