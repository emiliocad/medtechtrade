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
        $id = intval( $this->_request->getParam( 'id' ) );
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
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->view->assign(
                'operaciones' ,
                $this->_operacion->listByUserOperation(
                        $this->authData['usuario']->id ,
                        Mtt_Models_Bussines_EstadoOperacion::SALE
                )
        );
        }


    public function cotizarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );

        //Traer datos del equipo.
        $equipo = new Mtt_Models_Bussines_Equipo();
        $this->view->assign(
                'equipo' , $equipo->getProduct( $id )
        );

        //Datos de formas de pago
        $formaPago = new Mtt_Models_Bussines_EquipoFormaPago();
        $this->view->assign(
                'formaspago' , $formaPago->listByEquipo( $id )
        );
        }


    }