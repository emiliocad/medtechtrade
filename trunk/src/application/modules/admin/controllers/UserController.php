<?php

class Admin_UserController extends Mtt_Controller_Action
    {

    protected $_user;

    public function init()
        {
        parent::init();
        $this->_user = new Mtt_Models_Bussines_Usuario();
        }

    public function indexAction()
        {
        $this->view->assign(
                'usuarios' , $this->_user->listar()
        );
        }

    public function paginadoAction()
        {
        $p = $this->_user->getPaginator();

        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->assign( 'usuarios' , $p );
        }

    public function editarAction()
        {
        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Usuario();
        $form->removeElement( 'clave_2' );
        $form->submit->setLabel( 'Actualizar' );
        $usuario = $this->_user->getFindId( $id );

        if ( !is_null( $usuario ) )
            {
            if ( $this->_request->isPost()
                    &&
                    $form->isValid( $this->_request->getPost() ) )
                {
                $this->_fabricante->updateFabricante(
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

    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_user->deleteUsuario( $id );
        $this->_helper->FlashMessenger(
                $this->translate( 'Usuario Desactivado' )
        );
        $this->_redirect( $this->URL );
        }

//FIXME -verificar codigo para traducion
    public function nuevoAction()
        {
        $form = new Mtt_Form_Usuario();
        if ( $this->_request->isPost() &&
                $form->isValid( $this->_request->getPost() ) )
            {
            $user = $form->getValues();

            $this->_user->saveUsuario( $user );

            $this->_helper->FlashMessenger(
                    $this->translate( 'Se Registro el Usuario' )
            );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    //FIXME cambiar codigo de ver
    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_user->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    }

