<?php

class User_OperacionController extends Mtt_Controller_Action {

    protected $_operacion;

    public function init() {
        parent::init();
        $this->_operacion = new Mtt_Models_Bussines_Operacion();
    }

    public function indexAction() {
        $this->view->assign(
                'operaciones', $this->_operacion->listByOperation(
                        Mtt_Models_Bussines_EstadoOperacion::SALE)
        );
    }

    public function verAction() {
        $id = intval($this->_request->getParam('id'));
        $this->view->assign(
                'operacion', $this->_operacion->verDetalle($id)
        );
    }

    public function comprasactivasAction() {
        $this->view->jQuery()
                ->addOnLoad(
                        ' $(document).ready(function() {
                         
                          });'
        );
        //$this->_helper->layout->setLayout('layoutListado');
        //$id = intval( $this->_request->getParam( 'id' ) );
        $operaciones = $this->_operacion->paglistByUserSalesActive(
            $this->authData['usuario']->id,
            Mtt_Models_Bussines_EstadoOperacion::SALE
        );
        
        $operaciones->setCurrentPageNumber(
                $this->_getParam('page', 1));
        $this->view->assign(
        'operaciones', $operaciones
        );
    }

    public function comprasAction() {
        //$this->_helper->layout->setLayout('layoutListado');
        //$id = intval( $this->_request->getParam( 'id' ) );
        $this->view->assign(
                'operaciones', $this->_operacion->listByUserOperation(
                        $this->authData['usuario']->id, Mtt_Models_Bussines_EstadoOperacion::SALE
                )
        );
    }

}