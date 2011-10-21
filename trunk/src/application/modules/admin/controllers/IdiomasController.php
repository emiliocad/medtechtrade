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
        $this->view->assign(
                'titulo' , $this->_translate->translate( 'nuevo idioma' )
        );

        $form = new Mtt_Form_Idioma();
        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {

            $idioma = $form->getValues();

            $this->_idioma->saveIdioma( $idioma );

            $this->_helper->FlashMessenger(
                    $this->_translate->translate( 'se registro el idioma' ) );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    public function editAction()
        {

        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Idioma();

        $idioma = $this->_idioma->getFindId( $id );

        if ( !is_null( $idioma ) )
            {
            if ( $this->_request->isPost() && $form->isValid(
                            $this->_request->getPost() )
            )
                {
                $this->_idioma->updateEquipo( $form->getValues() , $id );
                $this->_helper->FlashMessenger(
                        $this->_translate( 'Se modificó el idioma' ) );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $idioma->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger(
                    $this->_translate->translate( 'No existe el idioma' ) );
            $this->_redirect( $this->URL );
            }
        }


    public function deleteAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_idioma->deleteEquipo( $id );
        $this->_helper->FlashMessenger(
                $this->_translate->translate( 'se elimino el idioma' )
        );
        $this->_redirect( $this->URL );
        }


    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_idioma->activarIdioma( $id );
        $this->_helper->FlashMessenger(
                $this->_translate->translate( 'idioma activado' )
        );
        $this->_redirect( $this->URL );
        }


    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_idioma->desactivarIdioma( $id );
        $this->_helper->FlashMessenger(
                $this->_translate->translate('Idioma desactivado')
        );
        $this->_redirect( $this->URL );
        }


    }

