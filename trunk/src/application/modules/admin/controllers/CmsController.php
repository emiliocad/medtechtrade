<?php


class Admin_CmsController
        extends Mtt_Controller_Action
    {

    protected $_pagina;


    public function init()
        {
        parent::init();
        $this->_pagina = new Mtt_Models_Bussines_Pagina();
        }


    public function indexAction()
        {
        $this->view->assign(
                'paginas' , $this->_pagina->listPagina()
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

            $this->_pagina->saveEquipo( $equipo );

            $this->_helper->FlashMessenger( $this->_translate->translate('Se Registro El Equipo' ));
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    public function editAction()
        {

        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Equipo();

        $equipo = $this->_pagina->getFindId( $id );

        if ( !is_null( $equipo ) )
            {
            if ( $this->_request->isPost() && $form->isValid(
                            $this->_request->getPost() )
            )
                {
                $this->_pagina->updateEquipo( $form->getValues() , $id );
                $this->_helper->FlashMessenger( $this->_translate->translate('Se modificó un fabricante' ));
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $equipo->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( $this->_translate->translate('No existe ese fabricante' ));
            $this->_redirect( $this->URL );
            }
        }


    public function deleteAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_pagina->deleteEquipo( $id );
        $this->_helper->FlashMessenger( $this->_translate->translate('Equipo Borrado' ));
        $this->_redirect( $this->URL );
        }


    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_pagina->activarEquipo( $id );
        $this->_helper->FlashMessenger( $this->_translate->translate('Equipo Activado' ));
        $this->_redirect( $this->URL );
        }


    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_pagina->desactivarEquipo( $id );
        $this->_helper->FlashMessenger( $this->_translate->translate('Equipo desactivado') );
        $this->_redirect( $this->URL );
        }


    }

