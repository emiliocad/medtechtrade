<?php


class User_CheckoutController
        extends Mtt_Controller_Action
    {

    protected $_operacionEquipo;


    public function init()
        {
        parent::init();
        $this->_operacionEquipo = new Mtt_Models_Catalog_OperationEquipo();
        }


    public function indexAction()
        {
        $id = ( int ) $this->getRequest()->getParam( 'id' );

        $equipo = new Mtt_Models_Bussines_Equipo();
        $carito = $equipo->getFindId( $id );
        //$this->mtt->cart = $equipo->getFindId( $id );
        //$this->operacionEquipo->clearOperacionDetalles();
        //$this->operacionEquipo->addOperacionDetalle( $carito );
        $dataOperacion = $this->_operacionEquipo->getOperacionDetalles();

        $this->view->assign(
                'equipo' , $dataOperacion
        );
        $form = new Mtt_Form_Checkout(
                        $dataOperacion
        );

        $this->view->assign( 'checkout' , $form );

        if ( $this->_request->isPost() )
            {
            $this->view->assign( 'checkoutValues' , $form->getValues() );
            }
        }


    public function cartAction()
        {
        
        }


    }

