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
            $_usuario = new Mtt_Auth_Adapter_DbTable_Mtt();

            $loginValido = $_usuario->authenticate( $login["login"] , $login["clave"] );
            if ( $loginValido )
                {
                $this->isAuth = true;
                $this->_redirect( '/admin/index' );
                
                } else
                {
                $this->_helper->FlashMessenger( 'Usuario o contraseña invalido' );
                $this->_redirect( '/index/login' );
                }
            }
        $this->view->assign('form' , $form);    
        
        }

    }