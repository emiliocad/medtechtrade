<?php

class Admin_PaisesController 
    extends Mtt_Controller_Action
    {

    protected $_pais;

    public function init()
        {
        parent::init();
        $this->_pais = new Mtt_Models_Bussines_Paises();
        }

    public function indexAction()
        {
        $this->view->assign(
                'paises' , $this->_pais->listar()
        );
        }

    
    public function nuevoAction()
        {
        $form = new Mtt_Form_Pais();
        if ( $this->_request->isPost() && 
                $form->isValid( $this->_request->getPost() ) )
            {

            $pais= $form->getValues();

            $this->_pais->insert( $pais );

            $this->_helper->FlashMessenger( 
                    $this->_translate->translate('se registro el pais' )
            );
            
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }

    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_pais->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }
        
        

    public function editarAction()
        {
        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_EditForm_Pais();
        
        $form->nombre->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' =>'paises',
                            'field' => 'nombre',
                            'exclude' => array (
                                'field' => 'id', 
                                'value' => $id)
                        )
                )
        );
        
        $pais = $this->_pais->getFindId( $id );

        if ( !is_null( $pais ) )
            {
            if ( $this->_request->isPost()
                    &&
                    $form->isValid( $this->_request->getPost() ) )
                {
                $this->_pais->updatePais(
                        $form->getValues() , $id
                );
                $this->_helper->FlashMessenger(
                        $this->_translate->translate( 'se modifico el pais' )
                );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $pais->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( 
                    $this->_translate->translate( 'no existe' ) );
            $this->_redirect( $this->URL );
            }
        }        
        
        

    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_pais->desactivarPais( $id );
        $this->_helper->FlashMessenger(
                $this->_translate->translate( 'pais desactivado' )
        );
        $this->_redirect( $this->URL );
        }        
        

    }

