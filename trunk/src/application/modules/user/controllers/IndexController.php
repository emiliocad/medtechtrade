<?php


class User_IndexController
        extends Mtt_Controller_Action
    {

    protected $_usuario;


    public function indexAction()
        {
        $this->_usuario = new Mtt_Models_Bussines_Equipo();
        $this->view->assign(
                'lastequipos' ,
                $this->_usuario->getLastEquipmentPublished(
                        $this->authData['usuario']->id
                )
        );
        }


    }