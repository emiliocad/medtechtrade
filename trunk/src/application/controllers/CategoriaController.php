<?php

class CategoriaController extends Zend_Controller_Action
    {

    public function init()
        {
        parent::init();
        $this->_usuario = new Application_Model_Usuario();
        //$this->_tag = new Application_Model_Tag();
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
        $this->view->headScript()->appendFile( '/js/user.sigunp.js' );
        $form = new Application_Form_Registrar();
        $this->view->form = $form;
        }

    
    public function verAction()
        {
        $id = $this->_getParam( 'id' , null );
        $this->view->id = $id;
        $this->view->u = $this->_usuario->fetchRow( 'id=' . $id )->toArray();
        }

    }

?>
