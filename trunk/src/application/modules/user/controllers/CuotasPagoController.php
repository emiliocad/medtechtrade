<?php


class User_CuotasPagoController
        extends Mtt_Controller_Action
    {

    protected $_cuotaspago;


    public function init()
        {
        parent::init();
        $this->_cuotaspago = new Mtt_Models_Bussines_CuotasPago();
        }


    public function indexAction()
        {
        $this->view->assign(
                'cuotaspago' , $this->_cuotaspago->listByUser(
                $this->authData['usuario']->id)
        );
        }
        

    public function listarAction()
        {
        
        $idOperacion = ( int ) ( $this->_getParam( 'id' , null ) );
        
        $this->view->assign(
                'cuotaspago' , $this->_cuotaspago->listByOperation(
                $idOperacion)
        );
        }
        
    }

