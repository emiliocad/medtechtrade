<?php

class User_UserController extends Mtt_Controller_Action
    {

    protected $_user;

    public function init()
        {
        parent::init();
        $this->_user = new Mtt_Models_Bussines_Usuario();
        }

    public function indexAction()
        {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $usuario = $identity['usuario'] ;
        
        $this->view->assign( 'usuario' , $usuario );
        }

    public function editarAction()
        {         
        
        $id = $this->authData['usuario']->id ;
        
        $form = new Mtt_Form_Usuario();
        $form->removeElement( 'clave_2' );
        $form->removeElement( 'clave' );
        $form->removeElement( 'tipousuario_id' );
        $form->removeElement( 'login' );
        $form->submit->setLabel( 'Actualizar' );
        
        $usuario = $this->_user->getFindId( $id );
        
        $this->view->assign( 'usuario' , $usuario );

        if ( !is_null( $usuario ) )
            {
            if ( $this->_request->isPost()
                    &&
                    $form->isValid( $this->_request->getPost() ) )
                {
                $this->_user->updateUsuario(
                        $form->getValues() , $id
                );
                $this->_helper->FlashMessenger(
                        $this->translate( 'Changed a User' )
                );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $usuario->toArray() );
            $this->view->assign( 'form' , $form );
            } else
            {
            $this->_helper->FlashMessenger( $this->translate( 'No User' ) );
            $this->_redirect( $this->URL );
            }
        }


    }

