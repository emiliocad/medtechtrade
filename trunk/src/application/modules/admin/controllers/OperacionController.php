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
                'operaciones', 
                $this->_operacion->listByOperation(
                        Mtt_Models_Bussines_EstadoOperacion::SALE)
        );
        }
     
    public function verAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->view->assign(
                'operacion' , $this->_operacion->verDetalle($id)
        );
        }    
        
        
    public function detallaroperacionAction() {
        $id = intval($this->_request->getParam('id'));
        $operationEquipo = new Mtt_Models_Bussines_OperationEquipo;
        $detalles =  $operationEquipo->getEquipmentsByOperation($id);
        $this->view->assign(
                'operaciones', $detalles
        );
    }        


    }