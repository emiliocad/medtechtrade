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
        $view->headTitle( 'Medtechtrade' )->headTitle( 'Desarrollo' )->setSeparator( ' - ' );

        $view->headLink()->prependStylesheet( '/css/template_css.css' );
        $view->headLink()->prependStylesheet( '/css/base.css' );
        $view->headLink()->prependStylesheet( '/css/grid-960/styles/reset.css' );
        $view->headLink()->prependStylesheet( '/css/grid-960/styles/960.css' );
        $view->headScript()->appendFile( '/js/jquery.min.js' );
        $view->headMeta()->appendHttpEquiv( 'Content-Type' , 'text/html; charset=UTF-8' );
        $view->headMeta()->appendHttpEquiv( 'Content-Language' , 'en-US' );
        $view->addHelperPath( 'Mtt/View/Helper' , 'Mtt_View_Helper' );
        }

    protected function _initActionHelpers()
        {
        Zend_Controller_Action_HelperBroker::addHelper(
                new Mtt_Controller_Action_Helper_Auth()
        );

        Zend_Controller_Action_HelperBroker::addHelper(
                new Mtt_Controller_Action_Helper_MyFlashMessenger()
        );

        }

    }
