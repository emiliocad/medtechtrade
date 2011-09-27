<?php


class IndexController
        extends Mtt_Controller_Action
    {

    protected $_equipo;


    public function init()
        {
        parent::init();
        $this->_equipo = new Mtt_Models_Catalog_Equipo();
        }


    public function indexAction()
        {

        $this->view->jQuery()
                ->addJavascriptFile(
                        'http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js'
                )
                ->addStylesheet(
                        'http://static.flowplayer.org/tools/css/standalone.css'
                )
                ->addStylesheet(
                        'http://static.flowplayer.org/tools/css/scrollable-buttons.css'
                )
                ->addStylesheet(
                        'http://static.flowplayer.org/tools/css/scrollable-horizontal.css'
                )
                ->addOnLoad(
                        '$(".scrollable").scrollable();'
                )
        ;
        $this->view->assign(
                'oferEquipo' , $this->_equipo->showEquiposOfers()
        );

//        $paginado = new Zend_Paginator_Adapter_Array( range( 1 , 9 ) );
//        $this->view->assign( 'items' , $paginado );
        }


    }

