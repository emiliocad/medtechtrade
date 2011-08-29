<?php

class UsuarioController extends Mtt_Controller_Action
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

        $form = new Mtt_Form_Login();

        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {
            $login = $this->_request->getPost();
            
            $_usuario = new Mtt_Models_Bussines_Usuario();

            $loginValido = $_usuario->auth( $form->getValue( "login" ) , $form->getValue( "clave" ) );
            if ( $loginValido )
                {
                $this->_redirect( '/admin/index' );
                } else
                {
                $this->_helper->FlashMessenger( 'Usuario o contraseña invalido' );
                $this->_redirect( '/usuario/index' );
                }
            }
        $this->view->assign( 'formlogin' , $form );
        }

    public function registroAction()
        {
        $this->view->headScript()->appendFile( '/js/user.sigunp.js' );
        $form = new Mtt_Form_Registrar();

        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $usuario = $form->getValues();

            unset( $usuario["clave_2"] );
            unset( $usuario["clave"] );

            $valuesDefault = array(
                "clave" => Mtt_Auth_Adapter_DbTable_Mtt::generatePassword( $form->getValue( 'clave' ) ) ,
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

    public function logoutAction()
        {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect( '/' );
        }

    }

?>
