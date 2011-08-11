<?php

class TestController extends Zend_Controller_Action
    {

    public function init()
        {
        /* Initialize action controller here */
        }

    public function indexAction()
        {
        $locale = new Zend_Locale();
        
        $this->view->assign( "locale" , $locale->getLanguage());
        }

    }

