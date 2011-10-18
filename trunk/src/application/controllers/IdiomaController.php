<?php


class IdiomaController
        extends Mtt_Controller_Action
    {


    public function init()
        {
        parent::init();
        /* Initialize action controller here */
        }


    public function indexAction()
        {
        $frmIdiomaPais = new Mtt_Form_IdiomaPais();
        $_config = new Mtt_Models_Bussines_Config();
        $_idioma = new Mtt_Models_Bussines_Idioma();

        if ( $this->_request->isPost()
        )
            {
            $data = $this->_request->getPost();

            if ( $data['recordar'] == 1 )
                {

                $_config->saveConfig( $data );
                }
//            if ( isset( $data['idioma'] ) && $data['idioma'] !== '-1' )
//                {
                $dataIdioma = $_idioma->getFindId( $data['idioma'] );
                $this->mtt->config->lang = $dataIdioma->prefijo;
                $this->mtt->config->idlang = $dataIdioma->id;
//                }

            $this->view->assign( 'form' , $this->_request->getPost() );
            $this->view->assign( 'data' , $this->mtt->config );

            //$this->_redirect( $_SERVER['HTTP_REFERER'] );
            }
        }


    public function englishAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );
        $mtt->lang = 'en';
        $this->view->assign( 'mtt' , $mtt );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function spanishAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );
        $mtt->lang = 'es';
        $this->view->assign( 'mtt' , $mtt );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function alemanAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );
        $mtt->lang = 'de';
        $this->view->assign( 'mtt' , $mtt );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function poloniaAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );
        $mtt->lang = 'pl';
        $this->view->assign( 'mtt' , $mtt );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    }

