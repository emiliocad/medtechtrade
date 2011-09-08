<?php

class IdiomaController extends Mtt_Controller_Action
    {

    public function init()
        {
        parent::init();
        /* Initialize action controller here */
        }

    public function indexAction()
        {
        
        }

    public function englishAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );
        $mtt->lang = 'en';
        $this->view->assign( 'mtt' , $mtt );
        $this->_redirect($_SERVER['HTTP_REFERER']);
        }

    public function spanishAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );
        $mtt->lang = 'es';
        $this->view->assign( 'mtt' , $mtt );
        $this->_redirect($_SERVER['HTTP_REFERER']);
        }

    public function alemanAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );
        $mtt->lang = 'de';
        $this->view->assign( 'mtt' , $mtt );
        $this->_redirect($_SERVER['HTTP_REFERER']);
        }

    }

