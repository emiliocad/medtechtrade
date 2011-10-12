<?php


class ContactusController
        extends Mtt_Controller_Action
    {

    protected $_contactus;


    public function init()
        {
        parent::init();
        $this->_contactus = new Mtt_Models_Bussines_Contactus();
        }


    public function indexAction()
        {
        $this->view->jQuery()
                ->addJavascriptFile(
                        '/js/jwysiwyg/jquery.wysiwyg.js'
                )
                ->addJavascriptFile(
                        '/js/contactus.js'
                )
                ->addStylesheet(
                        '/js/jwysiwyg/jquery.wysiwyg.css'
        );


        $form = new Mtt_Form_Contactar();

        if ( $this->_request->isPost() && 
                $form->isValid($this->_request->getPost()))
            {
           
                $contacto = $form->getValues();

                $paises = new Mtt_Models_Bussines_Paises();
                $pais = $paises->getFindId( $contacto['paises_id'] );
                $contacto['pais'] = $pais->nombre;
                $this->_contactus->sendMail(
                        $contacto ,
                        $this->_translate->translate( 'contactenos' )
                );
//$this->view->assign('contacto', $contacto);
    
            }
        else
            {
            $this->view->assign( 'formContactar' , $form );
            }
        }


    }

