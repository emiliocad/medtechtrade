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
                        'http://cdn.jquerytools.org/1.2.4/jquery.tools.min.js'
                )
                ->addStylesheet(
                        'http://flowplayer.org/tools/css/scrollale-buttons.css'
                )
//                ->addOnLoad(
//                        "alert('hola kusanagui');"
//                )
        ;
        $this->view->assign(
                'oferEquipo' , $this->_equipo->showEquiposOfers()
        );

        $paginado = new Zend_Paginator_Adapter_Array( range( 1 , 9 ) );
        $this->view->assign( 'items' , $paginado );
        }


    }

