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
        $id = ( int ) ( $this->_getParam( 'id' , null ) );

        $this->_equipo->updateView( $id );

        $this->view->assign(
                'producto' , $this->_equipo->getProduct( $id )
        );
        }


    }

