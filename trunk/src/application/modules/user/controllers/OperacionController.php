<?php


class User_OperacionController
        extends Mtt_Controller_Action
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
                'operaciones' ,
                $this->_operacion->listByOperation(
                        Mtt_Models_Bussines_EstadoOperacion::SALE )
        );
        }


    public function verAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->view->assign(
                'operacion' , $this->_operacion->verDetalle( $id )
        );
        }


    public function comprasactivasAction()
        {
        $this->view->jQuery()
                ->addOnLoad(
                        ' $(document).ready(function() {
                         
                          });'
                );
        $this->_helper->layout->setLayout( 'layoutListado' );
        //$id = intval( $this->_request->getParam( 'id' ) );
        $this->view->assign(
                'operaciones' ,
                $this->_operacion->listByUserSalesActive(
                        $this->authData['usuario']->id ,
                        Mtt_Models_Bussines_EstadoOperacion::SALE
                )
        );
        }


    public function comprasAction()
        {
        $this->_helper->layout->setLayout( 'layoutListado' );
        //$id = intval( $this->_request->getParam( 'id' ) );
        $this->view->assign(
                'operaciones' ,
                $this->_operacion->listByUserOperation(
                        $this->authData['usuario']->id ,
                        Mtt_Models_Bussines_EstadoOperacion::SALE
                )
        );
        }


    }