<?php

class TestController extends Mtt_Controller_Action
    {

    public function init()
        {
        /* Initialize action controller here */
        }

    public function indexAction()
        {
        $locale = new Zend_Locale();

        $this->view->assign( "locale" , $locale->getLanguage() );
        }

    public function testGoogleAction()
        {
        $yt = new Zend_Gdata_YouTube();
        $query = $yt->newVideoQuery();
        $query->videoQuery = 'cat';
        $query->startIndex = 10;
        $query->maxResults = 20;
        $query->orderBy = 'viewCount';

        $this->view->assign( 'query' , $query->queryUrl );
        $this->view->assign( 'videoFeed' , $yt->getVideoFeed( $query ) );
        }

    public function comboPaisAction()
        {
        $pais = new Mtt_Models_Bussines_Paises();

        $this->view->assign( 'combos' , $pais->getComboValues() );
        }

    public function fechaAction()
        {


        $this->view->assign( 'fecha' , Zend_Date::now( 'us' ) );
        }

    public function generateClaveAction()
        {


        $this->view->assign( 'password' , Mtt_Auth_Adapter_DbTable_Mtt::generatePassword( '123456' ) );
        }

    public function fabricanteAction()
        {

        $frmFabricante = new Mtt_Form_Fabricante();
        $this->view->assign( 'frmFabricante' , $frmFabricante );
        }

    }

