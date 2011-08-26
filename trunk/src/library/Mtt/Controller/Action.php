<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Controller_Action extends Zend_Controller_Action
    {

    public function init()
        {
        // inicializando logger
        $this->logger = new Zend_Log();
        $writer = new Zend_Log_Writer_Stream( APPLICATION_PATH . '/../logs/log.txt' );
        $this->logger->addWriter( $writer );
        $this->view->messages = $this->_helper->flashMessenger->getMessages();
        }

    public function preDispatch()
        {
        if ( $this->isAuth )
            {
            $this->authData = Zend_Auth::getInstance()->getStorage()->read();
            $this->view->authData = $this->authData;
            $this->view->authUser = $this->authData['usuario']->nombre;
            } else
            {
            $no_require_login_modules = array(
                'default'
            );
            $no_require_login_controllers = array(
                'test' ,
                'tests' ,
                'error' ,
                'api'
            );
            $no_require_login_actions = array(
                'default/usuario/registrar' ,
                'default/usuario/index'
            );

            $current_module = $this->_request->getModuleName();
            $current_controller = $this->_request->getControllerName();

            $current_action = $current_module . '/' . $current_controller . '/' . $this->_request->getActionName();

            if ( !in_array( $current_module , $no_require_login_modules ) )
                {
                if ( !in_array( $current_controller , $no_require_login_controllers ) )
                    {
                    if ( !in_array( $current_action , $no_require_login_actions ) )
                        {
                        $this->_helper->FlashMessenger( 'Debes Logearte' );
                        $this->_redirect( 'default/login/index' );
                        }
                    }
                }
            }
        parent::preDispatch();
        }

    }