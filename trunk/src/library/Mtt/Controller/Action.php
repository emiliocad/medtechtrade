<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Controller_Action
        extends Zend_Controller_Action
    {

    protected $URL;
    protected $_translate;
    protected $mtt;


    public function __call( $method , $args )
        {
        $this->_redirect( "/default/index/index" );
        }


    public function init()
        {
        // inicializando logger
        $this->logger = new Zend_Log();
        $writer = new Zend_Log_Writer_Stream(
                        APPLICATION_PATH . '/../logs/log.txt'
        );
        $this->logger->addWriter( $writer );
        $this->view->messages = $this->_helper->flashMessenger->getMessages();

        $this->URL =
                $this->getRequest()->getModuleName()
                . '/' . $this->getRequest()->getControllerName();

        /* agregando traduccion en Controller */
        $this->_translate = Zend_Registry::get( 'Zend_Translate' );
        /* fin de Traduccion */
        $this->mtt = new Zend_Session_Namespace( 'MTT' );
        }


    public function preDispatch()
        {

        if ( Zend_Auth::getInstance()->hasIdentity() )
            {
            $this->authData = Zend_Auth::getInstance()->getStorage()->read();
            $this->view->assign(
                    'authData' , $this->authData
            );

            $this->view->assign(
                    'authUser' , $this->authData['usuario']->nombre
            );
            $this->view->assign( 'formIdiomaPais' ,
                                 new Mtt_Form_IdiomaPais(
                            array(
                                'idioma' => $this->mtt->lang
                            )
                    )
            );
            }


//        if ( $this->isAuth )
//            {
//            }
//        else
//            {
//            $no_require_login_modules = array(
//                'default'
//            );
//            $no_require_login_controllers = array(
//                'test' ,
//                'tests' ,
//                'error' ,
//                'api'
//            );
//            $no_require_login_actions = array(
//                'default/usuario/registrar' ,
//                'default/usuario/index'
//            );
//
//            $current_module = $this->_request->getModuleName();
//            $current_controller = $this->_request->getControllerName();
//
//            $current_action = $current_module . '/' . $current_controller . '/' . $this->_request->getActionName();
//
//            if ( !in_array( $current_module , $no_require_login_modules ) )
//                {
//                if ( !in_array( $current_controller ,
//                                $no_require_login_controllers ) )
//                    {
//                    if ( !in_array( $current_action , $no_require_login_actions ) )
//                        {
//                        $this->_helper->FlashMessenger( 'Debes Logearte' );
//                        $this->_redirect( 'default/usuario/index' );
//                        }
//                    }
//                }
//            }
        parent::preDispatch();
        }


    }