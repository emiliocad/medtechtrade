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

        $this->view->assign( "locale" , $locale->getLanguage() );
        }

    public function translateGoogleAction()
        {
        $translate = new My_Translate_Adapter_Google();

        $this->view->assign( "google" , $translate->translate( 'hello' , 'es' ) );
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
       
        
        $this->view->assign( 'fecha' , Zend_Date::now( 'us') );
        
        }
   
        
        

    }

