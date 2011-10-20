<?php


class User_CheckoutController
        extends Mtt_Controller_Action
    {

    protected $operacionEquipo;


    public function init()
        {
        parent::init();
        $this->operacionEquipo = new Mtt_Models_Catalog_OperationEquipo();
        }


    public function indexAction()
        {
        $id = ( int ) $this->getRequest()->getParam( 'id' );

        $equipo = new Mtt_Models_Bussines_Equipo();
        $carito = $equipo->getFindId( $id );
        //$this->mtt->cart = $equipo->getFindId( $id );
        //$this->operacionEquipo->clearOperacionDetalles();
        //$this->operacionEquipo->addOperacionDetalle( $carito );
        


        $this->view->assign(
                'equipo' , $this->operacionEquipo->getOperacionDetalles()
        );
        $form = new Mtt_Form_Checkout();

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

