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

        $carrito = new Mtt_Store_Cart( $equipo->getFindId( $id ) );
        //$carito = $equipo->getFindId( $id );
        //$this->_operacionEquipo->clearOperacionDetalles();
        $this->_operacionEquipo->addOperacionDetalle( $carrito );

        $form = new Mtt_Form_Checkout(
                        $this->_operacionEquipo->getOperacionDetalles()
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

//            Zend_Debug::dump( $this->_operacionEquipo->getOperacionDetalles() );
//            exit;
//            $lastInsertId = $this->_operacion->saveOperacion( $dataOperacion );
//            if ( !is_null( $lastInsertId ) )
//                {
//                
//                
            $data = $form->getValues();
            $this->_operacionEquipo->fillDetalle( $data['carro'] );
//                $this->_operacionEquipo->saveOperacionDetalle(
//                        $this->authData['usuario']->id , $lastInsertId ,
//                        $form->getValues()
//                );
//                $this->_operacionEquipo->clearOperationDetalle();
//                }

            $data = $form->getValues();
            $this->view->assign( 'checkoutdata' , $this->_operacionEquipo->getOperacionDetalles() );
            }
        }


    public function cartAction()
        {
        
        }


    }

