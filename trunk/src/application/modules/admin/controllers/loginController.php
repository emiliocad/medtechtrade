<?php

class Admin_LoginController extends Mtt_Controller_Action
    {

    public function indexAction()
        {


        $form = new Mtt_Form_Login();

        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $login = $this->_request->getPost();

            $_usuario = new Mtt_Models_Bussines_Usuario();

            $loginValido = $_usuario->auth(
                    $form->getValue( "login" ) , $form->getValue( "clave" )
            );
            if ( $loginValido )
                {
                $this->_redirect( '/admin/index' );
                } else
                {
                $this->_helper->FlashMessenger( $this->_translate->translate('Usuario o contraseña invalido' ));
                $this->_redirect( '/admin/login/index' );
                }
            }
        $this->view->assign( 'form' , $form );
        }

    public function logoutAction()
        {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect( '/' );
        }

    }