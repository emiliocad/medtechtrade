<?php

class Admin_TipoUsuarioController extends Mtt_Controller_Action
    {

    protected $_tipoUsuario;

    public function init()
        {
        parent::init();
        $this->_tipoUsuario = new Mtt_Models_Bussines_TipoUsuario();
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
        $form = new Mtt_Form_Equipo();
        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $producto = $form->getValues();

            $this->_tipoUsuario->insert( $producto );

            $this->_helper->FlashMessenger( $this->_translate->translate('Se Registro La Categoria') );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_tipoUsuario->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    }

