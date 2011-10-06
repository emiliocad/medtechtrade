<?php

class ContactusController extends Mtt_Controller_Action
    {

   

    public function init()
        {
       parent::init();
        }

    public function indexAction()
        {
        $form = new Mtt_Form_Contactar();
        $this->view->assign( 'formContactar' , $form );
        }

    
    }

