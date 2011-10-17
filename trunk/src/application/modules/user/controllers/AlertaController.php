<?php

class User_AlertaController 
    extends Mtt_Controller_Action
    {

    protected $_alerta;

    public function init()
        {
        parent::init();
        $this->_alerta = new Mtt_Models_Bussines_Alerta();
        }

    public function indexAction()
        {
       
        }

    public function editarAction()
        {         
        
        }


    public function configurationAction( )
        {
        
        
        $form = new Mtt_Form_ConfigurarAlertas();
        
        $alertasUsuario = $this->_alerta->getAlertaByUser(
                $this->authData['usuario']->id
        );

   
        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {
                $alertas = $this->_request->getPost();
                $alertas['usuario_id'] = $this->authData['usuario']->id;
                
                if(empty($alertasUsuario)){
                    $this->_alerta->saveAlerta($alertas);
                    
                } else {
                    $this->_alerta->updateAlerta($alertas, $alertasUsuario);
                }
            
            }
            $this->view->assign( 'alertas' , $alertasUsuario );
            $this->view->assign( 'form' , $form );
        }

    }

