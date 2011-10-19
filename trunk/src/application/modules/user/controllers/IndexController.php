<?php


class User_IndexController
        extends Mtt_Controller_Action
    {

    protected $_equipo;
    protected $_reserva;


    public function indexAction()
        {
        $this->_reserva = new Mtt_Models_Bussines_Reserva();
        $this->_equipo = new Mtt_Models_Bussines_Equipo();

        $this->view->assign(
                'lastequipos' ,
                $this->_equipo->getLastEquipmentPublished(
                        $this->authData['usuario']->id
                )
        );

        $this->view->assign(
                'favoritos' ,
                $this->_reserva->getReservaByUser(
                        $this->authData['usuario']->id ,
                        Mtt_Models_Table_TipoReserva::FAVORITE
                )
        );
        }


    }