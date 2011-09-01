<?php

class Admin_UserController extends Mtt_Controller_Action
    {

    protected $_user;
    

    public function init()
        {
        parent::init();
        $this->_user = new Mtt_Models_Bussines_Usuario();
        
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

    public function editarAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function borrarAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

   

    public function nuevoAction()
        {
        $form = new Mtt_Form_Categoria();
        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {
            $categoria = $form->getValues();

            $this->_user->insert( $categoria );

            $this->_helper->FlashMessenger( 'Se Registro La Categoria' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function verAction()
        {
        $id = $this->_getParam( 'id' , null );
        $stmt = $this->_user->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    }

?>
