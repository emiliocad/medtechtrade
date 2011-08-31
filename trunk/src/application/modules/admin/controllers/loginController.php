<?php

class Admin_LoginController extends Mtt_Controller_Action
    {

    public function indexAction()
        {
        $this->_helper->layout->setLayout( 'layout_login' );

        $form = new Mtt_Form_Login();

        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $login = $this->_request->getPost();
            
            $_usuario = new Mtt_Models_Bussines_Usuario();

            $loginValido = $_usuario->auth( $form->getValue( "login" ) , $form->getValue( "clave" ) );
            if ( $loginValido )
                {
                $this->_redirect( '/admin/index' );
                } else
                {
                $this->_helper->FlashMessenger( 'Usuario o contraseña invalido' );
                $this->_redirect( '/admin/login/index' );
                }
            }
        $this->view->assign( 'form' , $form );
        }

    }