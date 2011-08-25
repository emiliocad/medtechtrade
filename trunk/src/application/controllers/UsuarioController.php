<?php

class UsuarioController extends Zend_Controller_Action
    {

    protected $_usuario;
    protected $URL;

    public function init()
        {

        $this->_usuario = new Mtt_Models_Bussines_Usuario();
        $this->URL = '/' . $this->getRequest()->getControllerName();
        parent::init();
        }

    public function indexAction()
        {
        
        }

    public function loginAction()
        {
        $frmlogin = new Mtt_Form_Login();
        $this->view->assign( 'formlogin' , $frmlogin );
        }

    public function paginadoAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function registroAction()
        {
        $this->view->headScript()->appendFile( '/js/user.sigunp.js' );
        $form = new Mtt_Form_Registrar();

        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {
            
            $usuario = $form->getValues();
            
            unset( $usuario["clave_2"] );

            $valuesDefault = array(
                "tipousuario_id" => '1' ,
                "fecharegistro" => Zend_Date::now() ,
                "ultimavisita" => Zend_Date::now()
            );
            
            $usuario = array_merge( $valuesDefault , $usuario );
            
            $this->_usuario->insert( $usuario );
            
            $this->_helper->FlashMessenger( 'Se Registro el Usuario' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    }

?>
