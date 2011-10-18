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
        
        $this->view->jQuery()->addJavascriptFile( '/js/alerta.js' );
        $this->view->jQuery()->addStylesheet('/css/alerta.css'
                );
        $form = new Mtt_Form_ConfigurarAlertas();
   
        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {
            
            $parametros = $this->_request->getPost();
            $alertas = $this->_alerta->getAlertas( 
                    $this->authData['usuario']->id
            );
            $parametros['usuario_id'] = $this->authData['usuario']->id;
            
            if(empty ($alertas)){
                $this->_alerta->saveAlerta($parametros
                );
            } else {
                $this->_alerta->updateConfigAlerta($parametros
                );
            }
            $categorias = $form->getValues();
            //$ids = $categorias['categorias'];
            //$listadoCategorias = implode(',', $ids);
            
            }
            $this->view->assign( 'form' , $form );
            
        }

    }

