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
      
        $preguntas = $this->_pregunta->pagListQuestionUnresolved();
        $preguntas->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'preguntas' , $preguntas );
        }

        

    public function questionunresolvedAction()
        {
        $this->view->assign(
                'preguntas' , $this->_pregunta->listQuestionUnresolved(
                )
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

