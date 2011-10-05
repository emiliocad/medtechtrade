<?php


class Mtt_Controller_Plugin_Routes
        extends Zend_Controller_Plugin_Abstract
    {

    public function routeStartup( Zend_Controller_Request_Abstract $request )
        {

        $routes = array(
            'slugCategory' => new Zend_Controller_Router_Route(
                    'category/:slug' ,
                    array(
                        'module' => 'default' ,
                        'controller' => 'categoria' ,
                        'action' => 'ver' ,
                        'slug' => ':slug'

                    )
            ) ,
            'slugEquipment' => new Zend_Controller_Router_Route(
                    'equipment/:slug' ,
                    array(
                        'module' => 'default' ,
                        'controller' => 'test' ,
                        'action' => 'slugequipment' ,
                        'slug' => ':slug'

                    )
            ) ,
            'login' => new Zend_Controller_Router_Route(
                    'login' ,
                    array(
                        'module' => 'default' ,
                        'controller' => 'usuario' ,
                        'action' => 'index'
                    )
            )
                )
        ;

//        $routes = array(
//            'usuario' => new Zend_Controller_Router_Route(
//                    'usuario/:id' ,
//                    array(
//                        'controller' => 'usuario' ,
//                        'action' => 'ver' ,
//                        'id' => ':id'
//                    )
//            ) ,
//            'slugfab' => new Zend_Controller_Router_Route(
//                    'fab/:slug' ,
//                    array(
//                        'controller' => 'fabricante' ,
//                        'action' => 'ver' ,
//                        'slug' => ':slug'
//                    )
//            ) ,
//            'soap' => new Zend_Controller_Router_Route(
//                    'api/ventas.wsdl' ,
//                    array(
//                        'controller' => 'tests' ,
//                        'action' => 'soap-server' ,
//                    )
//            ) ,
//            'kot' => new Zend_Controller_Router_Route(
//                    'avisos/:id-:slug' ,
//                    array(
//                        'controller' => 'tests' ,
//                        'action' => 'soap-server' ,
//                    )
//            ) ,
//            'reporte10' => new Zend_Controller_Router_Route(
//                    'reporte10' ,
//                    array(
//                        'controller' => 'reporte' ,
//                        'action' => 'ultimas-ventas'
//                    )
//            ) ,
//            'login' => new Zend_Controller_Router_Route(
//                    'login' ,
//                    array(
//                        'controller' => 'test' ,
//                        'action' => 'login'
//                    )
//            ) ,
//            'logout' => new Zend_Controller_Router_Route(
//                    'logout' ,
//                    array(
//                        'controller' => 'index' ,
//                        'action' => 'logout'
//                    )
//            ) ,
//            'pedido' => new Zend_Controller_Router_Route(
//                    'pedido' ,
//                    array(
//                        'module' => 'logistica' ,
//                        'controller' => 'pedido' ,
//                        'action' => 'index'
//                    )
//            ) ,
//            's1' => new Zend_Controller_Router_Route(
//                    'cat/:slug' ,
//                    array(
//                        'controller' => 'categoria' ,
//                        'action' => 'ver' ,
//                        'slug' => ':slug'
//                    )
//            )
//        );

        $router = Zend_Controller_Front::getInstance()->getRouter();
        $router->addRoutes( $routes );
        parent::routeStartup( $request );
        }


    }

?>
