<?php

class Admin_PreguntaController
        extends Mtt_Controller_Action
    {

    protected $_pregunta;


    public function init()
        {
        parent::init();
        $this->_pregunta = new Mtt_Models_Bussines_Pregunta();
        }


    public function indexAction()
        {
        $this->view->jQuery()
                ->addStylesheet(
                        $this->view->baseUrl().'/css/reserva.css'
        );
        $this->view->assign(
                'preguntas' , $this->_pregunta->listByUser(
                $this->authData['usuario']->id)
        );
        }


    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_pregunta->desactivaPregunta( $id );
        $this->_helper->FlashMessenger( 'Pregunta Borrado' );
        $this->_redirect( $this->URL );
        }


    


    }

