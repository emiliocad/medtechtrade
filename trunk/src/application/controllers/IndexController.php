<?php

class IndexController extends Zend_Controller_Action
    {

    public function init()
        {
        /* Initialize action controller here */
        }

    public function indexAction()
        {
        Zend_Layout::getMvcInstance()->setContentKey( 'detailsleft' );
        $this->view->assign("prueba", "detailsleft");
        Zend_Layout::getMvcInstance()->setContentKey( 'content' );
        $this->view->assign("prueba", "content");
        
        }

    }

