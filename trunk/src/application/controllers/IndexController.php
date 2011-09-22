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
        $this->view->assign(
                'oferEquipo' , $this->_equipo->showEquiposOfers()
        );
        }


    }

