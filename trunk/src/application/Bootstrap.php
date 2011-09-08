<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
    {

    public function _initView()
        {
        $docTypeHelper = new Zend_View_Helper_Doctype();
        $docTypeHelper->doctype( 'XHTML1_STRICT' );


        $this->bootstrap( 'layout' );
        $layout = $this->getResource( 'layout' );
        $view = $layout->getView();


        $view->headTitle( 'Medtechtrade' )
                ->headTitle( 'Desarrollo' )
                ->setSeparator( ' - ' );

        /* solo para el Modulo Default */
        $this->bootstrap( 'frontController' );
        $frontController = $this->getResource( 'frontController' );
        //TODO
//        $view->assign('frontController',$frontController);
//        $view->headLink()->prependStylesheet( '/theme/default/css/reset.css' )
//                ->headLink()->appendStylesheet( '/theme/default/css/default.css' );
//        /* end Deafult */

        $view->headMeta()->appendHttpEquiv( 'Content-Type' , 'text/html; charset=UTF-8' );

        $view->headMeta()->appendHttpEquiv( 'Content-Language' , 'en-US' );
        $view->addHelperPath( 'Mtt/View/Helper' , 'Mtt_View_Helper' );
        }

    public function _initJquery()
        {
        $this->bootstrap( 'layout' );
        $layout = $this->getResource( 'layout' );
        $view = $layout->getView();
        $view->addHelperPath(
                'ZendX/JQuery/View/Helper'
                , 'ZendX_JQuery_View_Helper' );

        $view->jQuery()->setVersion( '1.4.2' )
                ->setUiVersion( '1.8.2' )
                ->enable()
                ->uiEnable();
        }

//    public function _initJs()
//        {
//        $this->bootstrap( 'layout' );
//        $layout = $this->getResource( 'layout' );
//        $view = $layout->getView();
//        $view->headScript()->appendFile( 'https://apis.google.com/js/plusone.js' );
//        }

    protected function _initActionHelpers()
        {
        Zend_Controller_Action_HelperBroker::addHelper(
                new Mtt_Controller_Action_Helper_Auth()
        );

        Zend_Controller_Action_HelperBroker::addHelper(
                new Mtt_Controller_Action_Helper_MyFlashMessenger()
        );
        }

    protected function _initSession()
        {
        Zend_Session::start();
        }

    protected function _initZFDebug()
        {
        if ( 'development' == APPLICATION_ENV )
            {
            $options = array(
                'plugins' => array( 'Variables' ,
                    'File' => array( 'base_path' => APPLICATION_PATH ) ,
                    'Memory' ,
                    'Time' ,
                    'Registry' ,
                    'Exception' )
            );

            if ( $this->hasPluginResource( 'db' ) )
                {
                $this->bootstrap( 'db' );
                $db = $this->getPluginResource( 'db' )->getDbAdapter();
                $options['plugins']['Database']['adapter'] = $db;
                }

            if ( $this->hasPluginResource( 'cache' ) )
                {
                $this->bootstrap( 'cache' );
                $cache = $this - getPluginResource( 'cache' )->getDbAdapter();
                $options['plugins']['Cache']['backend'] = $cache->getBackend();
                }

            $debug = new ZFDebug_Controller_Plugin_Debug( $options );

            $this->bootstrap( 'frontController' );
            $frontController = $this->getResource( 'frontController' );
            $frontController->registerPlugin( $debug );
            }
        }

    }
