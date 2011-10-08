<?php

class ContactusController extends Mtt_Controller_Action {

    protected $_contactus;

    public function init() {
        parent::init();
        $this->_contactus = new Mtt_Models_Bussines_Contactus();
    }

    public function indexAction() {
        $form = new Mtt_Form_Contactar();



        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getPost())) {

                $contacto = $form->getValues();

                //obtener datos de pais
                $paises = new Mtt_Models_Bussines_Paises();
                $pais = $paises->getFindId($contacto['paises_id']);
                $contacto['pais'] = $pais->nombre;
                $this->_contactus->sendMail($contacto, 'contactenos');
                //$this->view->assign('contacto', $contacto);
            }
        } else {
            $this->view->assign('formContactar', $form);
        }
    }

}

