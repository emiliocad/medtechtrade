<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 */
class UsuarioController extends Zend_Controller_Action
    {

    public function init()
        {
        parent::init();
        $this->_usuario = new Application_Model_Usuario();
        //$this->_tag = new Application_Model_Tag();
        }

    public function indexAction()
        {
        $this->view->usuarios_unidos = $this->_usuario->unido();
        $this->view->usuarios = $this->_usuario->fetchAll();
        $this->view->tags = $this->_tag->fetchAll();
        }

    public function paginadoAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function registrarAction()
        {
        $this->view->headScript()->appendFile( '/js/usuario.registrar.js' );
        $form = new Application_Form_Registrar();
        $this->view->form = $form;
        }

    public function demoJsonAction()
        {
        $datos = array(
            'nombre' => "Juan" ,
            'apellido' => "Perez" ,
            'hijos' => array(
                'José' ,
                'Maria' ,
                'Pedro'
            )
        );

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $json = Zend_Json::encode( $datos );

        $this->getResponse()->appendBody( $json );
        }

    public function verAction()
        {
        $id = $this->_getParam( 'id' , null );
        $this->view->id = $id;
        $this->view->u = $this->_usuario->fetchRow( 'id=' . $id )->toArray();
        }

    }

?>
