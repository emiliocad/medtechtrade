<?php


class Admin_CategoriaController
        extends Mtt_Controller_Action
    {

    protected $_categoria;


    public function init()
        {
        parent::init();
        $this->_categoria = new Mtt_Models_Bussines_Categoria();
        }


    public function indexAction()
        {
        $this->view->assign(
                'categorias' , $this->_categoria->listCategory()
        );
        }


    public function registrarAction()
        {
        $form = new Mtt_Form_Categoria();
        if ( $this->_request->isPost() && $form->isValid(
                        $this->_request->getPost()
                )
        )
            {

            $categoria = $form->getValues();

            $this->_categoria->saveCategoria( $categoria );

            $this->_helper->FlashMessenger( 'Se Registro La Categoria' );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    public function editarAction()
        {
        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Categoria();

        $form->nombre->setAttrib( "readonly" , "readonly" )
                ->setRequired( false )
        ;

        $data = $this->_request->getPost();
        $nombre = ( string ) $this->_request->getParam( 'nombre' );
        unset( $data["nombre"] );
        unset( $data["MAX_FILE_SIZE"] );
        unset( $data["submit"] );

        $categoria = $this->_categoria->getFindId( $id );

        $upload = $form->thumbnail->getTransferAdapter();

        $target = str_replace(
                        ' ' , '' , $nombre
                ) . '_' . $id . '.jpg';

        $f = new Zend_Filter_File_Rename(
                        array(
                            'target' => $target ,
                            'overwrite' => true
                        )
        );

        $upload->addFilter( $f );


        if ( !is_null( $categoria ) )
            {
            if ( $this->_request->isPost() && $form->isValid(
                            $data )
            )
                {
                if ( $form->thumbnail->receive() )
                    {

                    $arrayTmp = array( 'thumbnail' => $target );

                    $data = array_merge( $data , $arrayTmp );

                    $this->_categoria->updateCategoria( $data , $id );
                    $this->_helper->FlashMessenger( 'Se modificó La Categoria' );
                    $this->_redirect( $this->URL );
                    }
                }
            $form->setDefaults( $categoria->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( 'No existe esa Categoria' );
            $this->_redirect( $this->URL );
            }
        }


    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_categoria->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }


    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_categoria->desactivarCategoria( $id );
        $this->_helper->FlashMessenger( 'Categoria Borrada' );
        $this->_redirect( $this->URL );
        }


    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_categoria->activarCategoria( $id );
        $this->_helper->FlashMessenger( 'Categoria Activado' );
        $this->_redirect( $this->URL );
        }


    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_categoria->desactivarCategoria( $id );
        $this->_helper->FlashMessenger( 'Categoria desactivado' );
        $this->_redirect( $this->URL );
        }


    }

