<?php


class UsuarioController
        extends Mtt_Controller_Action
    {

    const MODULE_ADMIN = '/admin/index/index';
    const MODULE_USER ='/user/index/index';


    protected $_usuario;
    protected $URL;


    public function init()
        {
        parent::init();
        $this->_usuario = new Mtt_Models_Bussines_Usuario();
        $this->URL = '/' . $this->getRequest()->getControllerName();
        parent::init();
        }


    public function indexAction()
        {

        if ( Zend_Auth::getInstance()->hasIdentity() )
            {

            switch (
            ( int ) $this->authData['usuario']->tipousuario_id
            )
                {
                case 1 :
                    $this->_redirect(
                            self::MODULE_ADMIN
                    );
                    break;
                case 3:
                    $this->_redirect(
                            self::MODULE_USER
                    );
                    break;
                }
            }
        $form = new Mtt_Form_Login();

        if ( $this->_request->isPost()
                &&
                $form->isValid(
                        $this->_request->getPost() )
        )
            {
            $login = $this->_request->getPost();

            $_usuario = new Mtt_Models_Bussines_Usuario();

            $loginValido = $_usuario->auth(
                    $form->getValue( "login" )
                    , $form->getValue( "clave" )
            );

            $this->view->assign( 'loginValido' , $loginValido );

            //Funcionalidad Remember me
            if ( $form->getValue( "remember" ) )
                {
                Zend_Session ::rememberMe( 60 * 60 * 24 * 7 );
                }
            else
                {
                Zend_Session::ForgetMe();
                }

            if ( $loginValido )
                {

                $user = $this->_usuario->findLogin( $form->getValue( "login" ) );
                switch (
                ( int ) $user->tipousuario_id
                )
                    {
                    case Mtt_Models_Bussines_TipoUsuario::MANAGER :
                        $this->_redirect(
                                self::MODULE_ADMIN
                        );
                        break;
                    case Mtt_Models_Bussines_TipoUsuario::USER :
                        $this->_redirect(
                                self::MODULE_USER
                        );
                        break;
                    }
                }
            else
                {
                $this->_helper->MyFlashMessenger(
                        $this->_translate->translate(
                                'User or Password Invalido'
                        )
                        , Mtt_Controller_Action_Helper_MyFlashMessenger::ERROR
                );
                $this->_redirect( '/usuario/index' );
                }
            }
        $this->view->assign( 'formlogin' , $form );
        }


    public function registroAction()
        {

        $this->view->headScript()->appendFile( '/js/user.sigunp.js' );


        $form = new Mtt_Form_Registrar();

        if ( $this->_request->isPost() )
            {
            if ( !$form->isValid( $this->_request->getPost() ) )
                {

                $this->_helper->MyFlashMessenger(
                        $this->_translate->translate(
                                'Error al Ingreso de Datos'
                        )
                        , Mtt_Controller_Action_Helper_MyFlashMessenger::ERROR
                );
                }
            }

        if ( $this->_request->isPost() &&
                $form->isValid( $this->_request->getPost() ) )
            {

            $usuario = $form->getValues();

            $this->_usuario->saveUsuario( $usuario );

            $this->_helper->MyFlashMessenger(
                    $this->_translate->translate(
                            'There has been registered a new user'
                    )
                    , Mtt_Controller_Action_Helper_MyFlashMessenger::SUCCESS
            );
            $this->_redirect( $this->URL );
            }

        $this->view->assign( 'frmRegistrar' , $form );
        }


    public function noAutorizadoAction()
        {
        $mtt = new Zend_Session_Namespace( 'MTT' );

        $this->view->assign( 'data' , $mtt->noAuth );
        }


    public function emailcheckAction()
        {
        $checkMail = $this->_getParam( 'validacion' , null );
        $data = $this->_usuario->activeUsuario( $checkMail );
        $this->view->assign( 'data' , $data );
        }


    public function logoutAction()
        {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect( '/' );
        }


    }

