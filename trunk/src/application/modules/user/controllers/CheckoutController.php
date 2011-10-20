<?php


class User_CheckoutController
        extends Mtt_Controller_Action
    {

    protected $_operacionEquipo;
    protected $_operacion;


    public function init()
        {
        parent::init();
        $this->_operacionEquipo = new Mtt_Models_Catalog_OperationEquipo();
        $this->_operacion = new Mtt_Models_Bussines_Operacion;
        }


    public function indexAction()
        {
        $id = ( int ) $this->getRequest()->getParam( 'id' );

        $equipo = new Mtt_Models_Bussines_Equipo();
        $carito = $equipo->getFindId( $id );

        $this->_operacionEquipo->addOperacionDetalle( $carito );

        $dataOperacion = $this->_operacionEquipo->getOperacionDetalles();

        $form = new Mtt_Form_Checkout(
                        $dataOperacion
        );

        $this->view->assign( 'checkout' , $form );

        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $dataOperacion = array(
                'usuario_id' => $this->authData['usuario']->id ,
                'fecha' => date( "Y-m-d" ) ,
                'fechainicio' => date( "Y-m-d" ) ,
                'estadooperacion_id' => Mtt_Models_Bussines_EstadoOperacion::SALE
            );

            $lastInsertId = $this->_operacion->saveOperacion( $dataOperacion );
            if ( !is_null( $lastInsertId ) )
                {
                $this->_operacionEquipo->saveOperacionDetalle();
                }
            }
        }


    public function cartAction()
        {
        
        }


    }

