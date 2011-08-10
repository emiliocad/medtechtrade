<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    public function _initView(){
        $docTypeHelper = new Zend_View_Helper_Doctype();
        $docTypeHelper->doctype('XHTML1_STRICT');
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->headTitle('Medtechtrade')->headTitle('Desarrollo')->setSeparator(' - ');
        $view->headLink()->prependStylesheet('/css/template_css.css');
        $view->headScript()->appendFile('/js/jquery.min.js');
        $view->headMeta()->appendHttpEquiv('Content-Type','text/html; charset=UTF-8');
        $view->headMeta()->appendHttpEquiv('Content-Language', 'en-US');
        $view->addHelperPath('My/View/Helper', 'My_View_Helper');
    }

//    // sesion 14
//    public function  run() {
//        $cacheManager = $this->getResource('cachemanager');
//        Zend_Registry::set('cache', $cacheManager->getCache('appdata'));
//        parent::run();
//    }

//    protected function _initDBProfiler()
//    {
//        $resourceDB = $this->getPluginResource('db');
//        $db = $resourceDB->getDbAdapter();
//        $prof = new Zend_Db_Profiler_Firebug('Fire Bug Profiler!!');
//        $prof->setEnabled(true);
//        $db->setProfiler($prof);
//
////        O poner estas 2 lineas en el application.ini
////        resources.db.params.profiler.enabled = "true"
////        resources.db.params.profiler.class = "Zend_Db_Profiler_Firebug"
//    }

//    protected function _initSessionHandler(){
//        $resourceDB = $this->getPluginResource('db');
//        $db = $resourceDB->getDbAdapter();
//        Zend_Db_Table_Abstract::setDefaultAdapter($db);
//        $config = array(
//            'name'           => 'session',
//            'primary'        => 'id',
//            'modifiedColumn' => 'modified',
//            'dataColumn'     => 'data',
//            'lifetimeColumn' => 'lifetime'
//        );
//        $saveHandler = new Zend_Session_SaveHandler_DbTable($config);
//        //$saveHandler->setLifetime($lifetime, $overrideLifetime);
//        Zend_Session::setSaveHandler($saveHandler);
//        Zend_Session::start();
//
//    }


//    public function _initTest(){
//        if (APPLICATION_ENV==='testing'){
//            $this->bootstrap('db');
//            $db = Zend_Db_Table::getDefaultAdapter();
//            $db->query(file_get_contents(APPLICATION_PATH.'/../docs/ventas1_test.sql'));
//        }
//    }
    
//    public function _initRegistry(){
//        $session = new Zend_Session_Namespace("VentasApp");
//        Zend_Registry::set("t", $session); // translations
//        Zend_Registry::set("config", $session); // configs
//        Zend_Registry::set("log", $session); // loggin
//        Zend_Registry::set("fm", $session); // flashMessenger
//        Zend_Registry::set("acl", $session); // flashMessenger
//    }
    
//    protected function _initTranslation(){
//        $session = new Zend_Session_Namespace("VentasApp");
//        Zend_Registry::set("t", $session); // translations
//        
//        $regT = Zend_Registry::get('t');
//        
//        $lang = isset($regT->lang)?$regT->lang:'es';
//        
//        if(isset($regT->lang)){
//            $lang = $regT->lang;
//        } else {
//            $lang = 'es';
//        }
//        
//        $_es = array(
//            'message1' => 'Mensaje 1',
//            'message2' => 'Mensaje 2',
//            'message3' => 'Mensaje 3');
//
//        $_en = array(
//            'message1' => 'Message 1',
//            'message2' => 'Message 2',
//            'message3' => 'Message 3');
//
//        $_de = array(
//            'message1' => 'Nachricht 1',
//            'message2' => 'Nachricht 2',
//            'message3' => 'Nachricht 3');
//
//        $content = '_'.$lang;
//        $t = new Zend_Translate(
//            array(
//                'adapter' => 'array',
//                'content' => $$content,
//                'locale' => $lang
//            )
//        );

//        $t->addTranslation(array('content' => $german, 'locale' => 'de'));
//        $t->addTranslation(array('content' => $english, 'locale' => 'en'));
//        $t = new Zend_Translate(array('adapter'=>'array','content' => array(),'locale'=>'es'));
//        $t->addTranslation(array('adapter'=>'array','content' => $_es, 'locale' => 'es'));
//        $t->addTranslation(array('adapter'=>'array','content' => $_de, 'locale' => 'de'));
//        $t->addTranslation(array('adapter'=>'array','content' => $_en, 'locale' => 'en'));
//        Zend_Locale::setDefault($lang);
        
//        $regT->t = $t;
//        
//    }
	
	
//
//    protected function _initRoutes() {
//        $routes = array(
//            'usuario' => new Zend_Controller_Router_Route(
//                'usuario/:id',
//                array(
//                    'controller' => 'usuario',
//                    'action' => 'ver',
//                    'id'=>':id'
//                )
//            ),
//            'slugfab' => new Zend_Controller_Router_Route(
//                'fab/:slug',
//                array(
//                    'controller' => 'fabricante',
//                    'action' => 'ver',
//                    'slug'=>':slug'
//                )
//            ),
//            'soap' => new Zend_Controller_Router_Route(
//                'api/ventas.wsdl',
//                array(
//                    'controller' => 'tests',
//                    'action' => 'soap-server',
//                )
//            ),
//            'kot' => new Zend_Controller_Router_Route(
//                'avisos/:id-:slug',
//                array(
//                    'controller' => 'tests',
//                    'action' => 'soap-server',
//                )
//            ),
//            'reporte10' => new Zend_Controller_Router_Route(
//                'reporte10',
//                array(
//                    'controller' => 'reporte',
//                    'action' => 'ultimas-ventas'
//                )
//            ),
//            'login' => new Zend_Controller_Router_Route(
//                'login',
//                array(
//                    'controller' => 'test',
//                    'action' => 'login'
//                )
//            ),
//            'logout' => new Zend_Controller_Router_Route(
//                'logout',
//                array(
//                    'controller' => 'index',
//                    'action' => 'logout'
//                )
//            ),
//            'pedido' => new Zend_Controller_Router_Route(
//                'pedido',
//                array(
//                    'module' => 'logistica',
//                    'controller' => 'pedido',
//                    'action' => 'index'
//                )
//            ),
//            's1' => new Zend_Controller_Router_Route(
//                'cat/:slug',
//                array(
//                    'controller' => 'categoria',
//                    'action' => 'ver',
//                    'slug' => ':slug'
//                )
//            )
//        );
//        $this->frontController->getRouter()->addRoutes($routes);
//    }
//	
//    protected function _initAcl(){
//        
//        $acl = new Zend_Acl();
//        $acl->addRole('admin');
//        $acl->addRole('ventas');
//        $acl->addRole('supervisor_ventas','ventas');
//        $acl->addRole('logistica');
//        $acl->addResource('productos');
//        $acl->addResource('categorias');
//        $acl->addResource('fabricantes');
//        $acl->addResource('reportes');
//        $acl->allow('ventas','productos','vender');
//        $acl->allow('logistica','reportes','ultimos10');
//        $acl->allow('supervisor_ventas','reportes','ultimos10');
//        $acl->allow('admin');
//        // guardamos la ACL en sesi�n
//        $regAcl = Zend_Registry::get('acl');
//        $regAcl->acl = $acl;
//
//    }
}