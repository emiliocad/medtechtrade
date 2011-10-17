<?php


class Admin_IdiomasController
        extends Mtt_Controller_Action
    {

    protected $_idioma;


    public function init()
        {
        parent::init();
        $this->_idioma = new Mtt_Models_Bussines_Idioma();
        }


    public function indexAction()
        {
        $this->view->assign(
                'idiomas' , $this->_idioma->listar()
        );
        }


    public function newAction()
        {
        $form = new Mtt_Form_Equipo();
        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {

            $equipo = $form->getValues();
            $equipo_new = array(
                'usuario_id' => $this->authData['usuario']->id
            );
            $equipo = array_merge( $equipo , $equipo_new );

            $this->_idioma->saveEquipo( $equipo );

            $this->_helper->FlashMessenger( 'Se Registro El Equipo' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    public function editAction()
        {

        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Equipo();

        $equipo = $this->_idioma->getFindId( $id );

        if ( !is_null( $equipo ) )
            {
            if ( $this->_request->isPost() && $form->isValid(
                            $this->_request->getPost() )
            )
                {
                $this->_idioma->updateEquipo( $form->getValues() , $id );
                $this->_helper->FlashMessenger( 'Se modificó un fabricante' );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $equipo->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( 'No existe ese fabricante' );
            $this->_redirect( $this->URL );
            }
        }


    public function deleteAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_idioma->deleteEquipo( $id );
        $this->_helper->FlashMessenger( 'Equipo Borrado' );
        $this->_redirect( $this->URL );
        }


    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_idioma->activarEquipo( $id );
        $this->_helper->FlashMessenger( 'Equipo Activado' );
        $this->_redirect( $this->URL );
        }


    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_idioma->desactivarEquipo( $id );
        $this->_helper->FlashMessenger( 'Equipo desactivado' );
        $this->_redirect( $this->URL );
        }


    }

