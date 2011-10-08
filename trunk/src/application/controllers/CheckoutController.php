<?php


class CheckoutController
        extends Mtt_Controller_Action
    {


    public function init()
        {
        parent::init();
        /* Initialize action controller here */
        }


    public function indexAction()
        {
        $id = ( int ) $this->getRequest()->getParam( 'id' );
        $equipo = new Mtt_Models_Bussines_Equipo();
        //$equipo->getFindId( $id )
        $item = new Mtt_Store_Cart_Item( $equipo );

        $this->view->assign( 'equipo' , $id );
        }


    public function cartAction()
        {
        
        }


    }

