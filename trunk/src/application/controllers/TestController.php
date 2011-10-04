<?php


class TestController
        extends Mtt_Controller_Action
    {


    public function init()
        {
        parent::init();
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


        $this->view->assign( 'password' ,
                             Mtt_Auth_Adapter_DbTable_Mtt::generatePassword( '123456' ) );
        }


    public function fabricanteAction()
        {

        $frmFabricante = new Mtt_Form_Fabricante();
        $this->view->assign( 'frmFabricante' , $frmFabricante );
        }


    public function dateAction()
        {
        
        }


    public function mailAction()
        {
        //TODO falta transformarlo a todo
        $_conf = new Zend_Config_Ini( APPLICATION_PATH . '/configs/mail.ini' );

        $config = array(
            'auth' => 'login' ,
            'username' => 'checklist@pl-group.biz' ,
            'password' => '12345678' ,
            'port' => 25 );
        $this->mailTransport = new Zend_Mail_Transport_Smtp( 'smtp.1and1.com' ,
                        $config
        );

        Mtt_Html_Mail_Mailer::setDefaultFrom();
        Zend_Mail::setDefaultFrom(
                'checklist@pl-group.biz' , 'Zend GData'
        );
        Zend_Mail::setDefaultTransport( $this->mailTransport );
        Zend_Mail::setDefaultFrom(
                'checklist@pl-group.biz' , 'Zend GData'
        );
        Zend_Mail::setDefaultReplyTo(
                'checklist@pl-group.biz' , 'Zend GData'
        );

        $m = new Mtt_Html_Mail_Mailer();
        $m->setSubject( "Hello!" );
        $m->addTo( "slovacus@gmail.com" );
        $m->setViewParam( 'name' , 'Luis Alberto Mayta' );
        $m->sendHtmlTemplate( "index.phtml" );

        $confMail = $_conf->toArray();

        //$this->view->assign( 'conf' , $confMail['auth'] );
        }


    public function captchaAction()
        {
        $loginCaptcha = new Mtt_Form_LoginCaptcha();
        $this->view->assign( 'form' , $loginCaptcha );
        }


    public function slugAction()
        {
        $_categoria = new Mtt_Models_Bussines_Categoria();
        $slugger = new Mtt_Filter_Slug(
                        array(
                            'field' => 'slug' ,
                            'model' => $_categoria
                        )
        );
        $categorias = $_categoria->listar();
        $slug = array( );
        foreach ( $categorias as $categoria )
            {
            $slug[$categoria->id] = $slugger->filter( $categoria->nombre );
            }

        $this->view->assign(
                'slug' , $slug
        );
        }


    public function slugequipmentAction()
        {
//        $_categoria = new Mtt_Models_Catalog_Equipo();
//        $slugger = new Mtt_Filter_Slug(
//                        array(
//                            'field' => 'slug' ,
//                            'model' => $_categoria
//                        )
//        );
//        $categorias = $_categoria->listar();
//        $slug = array( );
//        foreach ( $categorias as $categoria )
//            {
//            $slug[$categoria->id] = $slugger->filter( $categoria->nombre );
//            }
//
//        $this->view->assign(
//                'slug' , $slug
//        );

        $slug = $this->_getParam( 'slug' , null );

        $this->view->assign( 'slug' , $slug );
        }


    }

