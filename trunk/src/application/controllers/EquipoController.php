<?php


class EquipoController
        extends Mtt_Controller_Action
    {


    public function init()
        {
        parent::init();
        $this->_equipo = new Mtt_Models_Bussines_Equipo();
        }


    public function indexAction()
        {
        
        }


    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );

        $this->view->assign(
                'producto' , $this->_equipo->getProduct( $id )
        );
        }


    }

