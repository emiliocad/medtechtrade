<?php

class Admin_AlertaController 
    extends Mtt_Controller_Action {

    protected $_alerta;

    public function init() {
        parent::init();
        $this->_alerta = new Mtt_Models_Bussines_Alerta();
    }

    public function indexAction() 
        {

        }

    public function sendtoEmailAction() 
        {
        
        }


}

