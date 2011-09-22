<?php

class Admin_OperacionController extends Mtt_Controller_Action
    {

    protected $_operacion;

    public function init()
        {
        parent::init();
        $this->_operacion = new Mtt_Models_Bussines_Operacion();
        }

    public function indexAction()
        {
        $this->view->assign(
                'operaciones', $this->_operacion->listByOperation(2)
        );
        }
     
    public function verAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->view->assign(
                'operacion' , $this->_operacion->verDetalle($id)
        );
        }        


    }