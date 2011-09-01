<?php

class Admin_FabricanteController extends Mtt_Controller_Action
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
        if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
            {

            $fabricante = $form->getValues();

            $this->_fabricante->insert( $fabricante );

            $this->_helper->FlashMessenger( 'Se Registro El Fabricante' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function editarAction()
        {
        
        $id = $this->_getParam( 'id' );

        $form = new Mtt_Form_Fabricante();
        
        $fabricante = $this->_fabricante->getFindId( $id );
        
        if ( !is_null( $fabricante ) )
            {
            if ( $this->_request->isPost() && $form->isValid( $this->_request->getPost() ) )
                {
                $this->_fabricante->updateFabricante( $form->getValues() , $id );
                $this->_helper->FlashMessenger( 'Se modificó un fabricante' );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $fabricante->toArray() );
            $this->view->assign( 'form' , $form );
            } else
            {
            $this->_helper->FlashMessenger( 'No existe ese fabricante' );
            $this->_redirect( $this->URL );
            }
        }

    public function borrarAction()
        {
        $id = $this->_request->getParam( 'id' );
        $this->_fabricante->delete( 'id=' . $id );
        $this->_helper->FlashMessenger( 'Fabricante borrado' );
        $this->_redirect( $this->URL );
        }

    public function activarAction()
        {
        $id = $this->_request->getParam( 'id' );
        $this->_fabricante->update( array( 'active' => 1 ) , 'id=' . $id );
        $this->_helper->FlashMessenger( 'Fabricante activado' );
        $this->_redirect( $this->URL );
        }

    public function desactivarAction()
        {
        $id = $this->_request->getParam( 'id' );
        $this->_fabricante->update( array( 'active' => 0 ) , 'id=' . $id );
        $this->_helper->FlashMessenger( 'Fabricante desactivado' );
        $this->_redirect( $this->URL );
        }

    }

?>
