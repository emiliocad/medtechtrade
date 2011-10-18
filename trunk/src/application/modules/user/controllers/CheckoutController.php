<?php


class User_CheckoutController
        extends Mtt_Controller_Action
    {

    protected $mtt;


    public function init()
        {
        parent::init();
        $this->mtt = new Zend_Session_Namespace( 'MTT' );
        }


    public function indexAction()
        {
        $id = ( int ) $this->getRequest()->getParam( 'id' );

        $equipo = new Mtt_Models_Bussines_Equipo();
        $carito += array( $id );
        //$this->mtt->cart = $equipo->getFindId( $id );
        $this->mtt->cart = $carito;
        //
        //$item = new Mtt_Store_Cart_Item( $equipo );
        //$this->view->assign('carro' , $value);

        $this->view->assign( 'equipo' , $this->mtt->cart );
        }


    public function cartAction()
        {
        
        }


    }

