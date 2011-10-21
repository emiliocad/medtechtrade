<?php

class Admin_FabricanteController 
    extends Mtt_Controller_Action
    {

    protected $_fabricante;

    public function init()
        {
        parent::init();
        $this->_fabricante = new Mtt_Models_Bussines_Fabricante();
        }

    public function indexAction()
        {

        $this->view->assign( 'fabricantes' , $this->_fabricante->listar() );
        }

    public function paginadoAction()
        {
        
        }

    public function nuevoAction()
        {
        $form = new Mtt_Form_Fabricante();
        if ( $this->_request->isPost() && 
                $form->isValid( $this->_request->getPost() ) )
            {

            $fabricante = $form->getValues();

            $this->_fabricante->saveFabricante( $fabricante );

            $this->_helper->FlashMessenger( 
                    $this->_translate->translate ('se registro el fabricante' )
            );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function editarAction()
        {

        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_EditForm_Fabricante();

        $fabricante = $this->_fabricante->getFindId( $id );

        if ( !is_null( $fabricante ) )
            {
            if ( $this->_request->isPost() 
                    && $form->isValid( $this->_request->getPost() ) )
                {
                $this->_fabricante->updateFabricante( $form->getValues() , $id );
                $this->_helper->FlashMessenger( 
                        $this->_translate->translate ('se modifico el fabricante' )
                );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $fabricante->toArray() );
            $this->view->assign( 'form' , $form );
            } else
            {
            $this->_helper->FlashMessenger( 
                    $this->_translate->translate ('no existe ese fabricante' )
            );
            $this->_redirect( $this->URL );
            }
        }

    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_fabricante->deleteFabricante( $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate ('fabricante borrado' )
        );
        $this->_redirect( $this->URL );
        }

    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_fabricante->update( array( 'active' => 1 ) , 'id=' . $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate ('fabricante activado' )
        );
        $this->_redirect( $this->URL );
        }

    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_fabricante->update( array( 'active' => 0 ) , 'id=' . $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate ('fabricante desactivado' )
        );
        $this->_redirect( $this->URL );
        }

    }

