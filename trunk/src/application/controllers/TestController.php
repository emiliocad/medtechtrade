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


//        $days = array(
//            'monday' => 'Lunes' ,
//            'Tuesday' => 'Martes' ,
//            'Wednesday' => 'Miercoles' ,
//            'Thursday' => 'jueves' ,
//            'Friday' => 'Viernes' ,
//            'Saturday' => 'Sabado' ,
//            'Sunday' => 'Domingo'
//        );
//        $month = array(
//            '' => 'Lunes' ,
//            'Tuesday' => 'Martes' ,
//            'Wednesday' => 'Miercoles' ,
//            'Thursday' => 'jueves' ,
//            'Friday' => 'Viernes' ,
//            'Saturday' => 'Sabado' ,
//            'Sunday' => 'Domingo'
//        );
        $dias = array(
            "Domingo" ,
            "Lunes" ,
            "Martes" ,
            "Miercoles" ,
            "Jueves" ,
            "Viernes" ,
            "Sábado"
        );
        $mes = array(
            "Diciembre" ,
            "Enero" ,
            "Febrero" ,
            "Marzo" ,
            "Abril" ,
            "Mayo" ,
            "Junio" ,
            "Julio" ,
            "Agosto" ,
            "Septiembre" ,
            "Octubre" ,
            "Noviembre"
        );
        //echo "Hoy es " . $dias[date( 'w' )];

        $date = Zend_Date::now()->toString( "YYYY-MM-dd hh-mm-ss" );

        $this->view->assign( 'date' , $date );
        $this->view->assign( 'fecha' , Zend_Date::now( 'us' ) );
        $fecha = date( 'd' ) . " " . $mes[date( 'm' )] . ' | ' . date( 'Y' );
        $this->view->assign( 'fecha2' , $fecha );
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
//        $date = new Zend_Date( now("Y-M-D") );
//        $this->view->assign( 'date' , $date->__toString( "yyyy/mm/dd" ) );

        $this->view->assign( 'date1' , date( 'y-m-d' ) );
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
        $_equipo = new Mtt_Models_Catalog_Equipo();
        $slugger = new Mtt_Filter_Slug(
                        array(
                            'field' => 'slug' ,
                            'model' => $_equipo
                        )
        );
        $equipos = $_equipo->listar();
        $slug = array( );
        foreach ( $equipos as $equipo )
            {
            $slug[$equipo->id] = $slugger->filter( $equipo->nombre );
            }

        $this->view->assign(
                'slug' , $slug
        );
        }


    public function formAction()
        {
        $test = new Mtt_Form_Test();
        $test->nombre->setValue( 'Slovacus' );


        $this->view->assign( 'test' , $test );
        }


    public function authAction()
        {

        $auth = Zend_Auth::getInstance()->getIdentity();


        $this->view->assign( 'auth' , $auth );
        }


    public function shorturlAction()
        {

        $short = new Mtt_Service_ShortUrl_BitLy(
                        'slovacus' ,
                        'R_7fa5a01a8f6192e8ebe2f56a14868126'
        );
        $short->shorten( 'http://www.google.com' );
        $this->view->assign( 'short' , $short );
        $this->view->assign(
                'url' , $short->shorten( 'http://www.google.com' )
        );
        }


    public function imagesAction()
        {
        $image = new Mtt_Service_Image();
        $ruta1 = APPLICATION_PUBLIC . '/media/catalog/product/copa-de-vino.jpg';
        $ruta2 = 'prueba.jpg';
        $image->processImageAvata( $ruta1
                , $ruta2 );
        $image->processImageEquipo( $ruta1
                , $ruta2 );
        $image->processImageProduct( $ruta1
                , $ruta2 );
        $image->processImageThumb( $ruta1
                , $ruta2 );
        $config = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/images.ini' , 'production'
        );
        $data = $config->toArray();
        $this->view->assign( 'config' , $data );

        $dir = APPLICATION_PUBLIC . '/media/catalog';
        $dir = Mtt_Utility_Convert::DirectorySeparator( $dir );
        $this->view->assign( 'dir' , $dir );
        $module = "module";
        $userName = "username";
        $path = implode( DS ,
                         array( $module , $userName , date( 'Y' ) , date( 'm' ) ) );
        Mtt_Utility_File::createDirs( $dir , $path );
        }


    public function frmimagenAction()
        {
        $imagen = new Mtt_Form_Imagen();

        $this->view->assign( 'imagen' , $imagen );

        $_imagen = new Mtt_Models_Bussines_Imagen();

        $slugger = new Mtt_Filter_Slug(
                        array(
                            'field' => 'nombre' ,
                            'model' => $_imagen
                        )
        );

        $target = $slugger->filter( $imagen->getValue( 'nombre' ) ) . '.jpg';

        $this->view->assign( 'target' , $target );
        }


    public function frmidiomapaisAction()
        {
        $frm = new Mtt_Form_IdiomaPais();
        $this->view->assign( 'frm' , $frm );
        }


    }

