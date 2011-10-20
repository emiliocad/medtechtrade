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
                ->addOnLoad(
                        ' 
                        $("a.rpta").click(function(){ 
                            
                            var id = ($(this).attr("id")); 
                            $("#id").attr("value", id);
                            $( "#dg-rpta" ).dialog({
                                height: 320,
                                width: 580,
                                modal: true
                            });
                        });  
                        $("#dg-rpta").css("display", "none");
                        '
                        
        );
        
        $form = new Mtt_Form_AnswerQuestion();
        $this->view->assign( 'formAnswer' , $form );
        
        $preguntas = $this->_pregunta->pagListQuestion();
        $preguntas->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'preguntas' , $preguntas );
        }


    public function answerquestionAction()
        {
        //$this->_helper->layout()->disableLayout();
        $form = new Mtt_Form_AnswerQuestion();
        $id = intval( $this->_request->getParam( 'id' ) );
        if ( $this->_request->isPost() 
                && $form->isValid( $this->_request->getPost() ) )
            {
           
            $data = $form->getValues();
            unset($data['submit']);
            $this->_pregunta->responderPregunta($data, $id);
            
            }
          
        $this->_redirect( $this->URL );
        }        
        

    public function questionunresolvedAction()
        {
        $this->view->jQuery()
                ->addOnLoad(
                        ' 
                        $("a.rpta").click(function(){ 
                            
                            var id = ($(this).attr("id")); 
                            $("#id").attr("value", id);
                            $( "#dg-rpta" ).dialog({
                                height: 320,
                                width: 580,
                                modal: true
                            });
                        });  
                        $("#dg-rpta").css("display", "none");
                        '
                        
        );
        
        $form = new Mtt_Form_AnswerQuestion();
        $this->view->assign( 'formAnswer' , $form );
        
        $preguntas = $this->_pregunta->pagListQuestionUnresolved();
        $preguntas->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'preguntas' , $preguntas );
        }
        

    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_pregunta->desactivaPregunta( $id );
        $this->_helper->FlashMessenger( 'Pregunta Borrado' );
        $this->_redirect( $this->URL );
        }


    


    }

