<?php

class Admin_MonedaController extends Mtt_Controller_Action
    {

    protected $_moneda;

    public function init()
        {
        parent::init();
        $this->_moneda = new Mtt_Models_Bussines_Moneda();
        }

    public function indexAction()
        {
        $this->view->assign(
                'monedas', $this->_moneda->listar()
        );
        }

    public function paginadoAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function nuevoAction()
        {
        $form = new Mtt_Form_Moneda();
        if ( $this->_request->isPost() 
                && $form->isValid( $this->_request->getPost() ) )
            {

            $moneda = $form->getValues();

            $this->_moneda->saveMoneda( $moneda );

            $this->_helper->FlashMessenger( 
                    $this->_translate->translate ('se registro la moneda' )
            );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_moneda->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }
        
    public function editarAction()
        {
        
        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_EditForm_Moneda();

        $moneda = $this->_moneda->getFindId( $id );
        $this->view->assign( 'moneda' , $moneda );

        if ( !is_null( $moneda ) )
            {
            if ( $this->_request->isPost() && $form->isValid(
                            $this->_request->getPost() )
            )
                {
                $this->_moneda->updateMoneda( $form->getValues() , $id );
                $this->_helper->FlashMessenger( 
                        $this->_translate->translate ('se modifico la moneda' ) 
                );
                $this->_redirect( $this->URL );
                }
             $form->setDefaults( $moneda->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( 
                    $this->_translate->translate ('no existe esa moneda' ) 
            );
            $this->_redirect( $this->URL );
            }
        
        }
        
   
    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_moneda->deleteMoneda( $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate ('moneda borrada' )
        );
        $this->_redirect( $this->URL );
        }


    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_moneda->activarMoneda( $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate ('moneda activado' )
        );
        $this->_redirect( $this->URL );
        }


    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_moneda->desactivarMoneda( $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate ('moneda desactivada' )
        );
        $this->_redirect( $this->URL );
        }


    }
    
    