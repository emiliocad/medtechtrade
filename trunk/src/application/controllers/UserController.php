<?php

class UserController extends Zend_Controller_Action
    {

    public function init()
        {
        parent::init();
        //$this->_usuario = new Application_Model_User();
        //$this->_tag = new Application_Model_Tag();
        }

    public function indexAction()
        {
        
        }

    public function loginAction()
        {
        $frmlogin = new Application_Form_Login();
        $this->view->assign( 'formlogin' , $frmlogin );
        }

    public function paginadoAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function signUpAction()
        {
        $this->view->headScript()->appendFile( '/js/user.sigunp.js' );
        $form = new Application_Form_Registrar();
        $this->view->assign( 'form' , $form );
        }

    }

?>
