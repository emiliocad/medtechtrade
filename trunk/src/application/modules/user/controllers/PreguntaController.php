<?php

class User_PreguntaController
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
   

    public function nuevoAction( )
        {
        
        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );
        
        $form = new Mtt_Form_Pregunta();
        $form->removeElement( 'respuesta' );
        
        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {

            $pregunta = $form->getValues();
            
            //Cambiar fecha formulacion, sincronizar con server.
            
            $pregunta_new = array(
                'usuario_id' => $this->authData['usuario']->id,
                'categoriapregunta_id' => 1,
                'equipo_id' => $idEquipo,
                'fechaFormulacion' => date("Ymd G:i:s")
            );
        
            $pregunta = array_merge( $pregunta , $pregunta_new );
            
            $this->_pregunta->savePregunta( $pregunta );

            $this->_helper->FlashMessenger( 'Se Registro la pregunta' );
            }
        
        $this->view->assign( 'frmRegistrar' , $form );
        }


    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_pregunta->desactivaPregunta( $id );
        $this->_helper->FlashMessenger( 'Pregunta Borrado' );
        $this->_redirect( $this->URL );
        }


    


    }

