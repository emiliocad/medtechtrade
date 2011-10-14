<?php


class User_ImagenController
        extends Mtt_Controller_Action
    {

    protected $_imagen;


    public function init()
        {
        parent::init();
        $this->_imagen = new Mtt_Models_Bussines_Imagen();
        }


    public function indexAction()
        {
        
        }


    public function editarAction()
        {
        
        }


    public function nuevoAction()
        {
        $idEquipo = ( int ) $this->_getParam( 'id' , null );

        $form = new Mtt_Form_Imagen();

        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {

            unset( $data["MAX_FILE_SIZE"] );
            unset( $data["submit"] );

            $imagen = $form->getValues();
            $upload = $form->imagen->getTransferAdapter();

            $target = str_replace(
                            ' ' , '' , $nombre
                    ) . '_' . $idEquipo . '.jpg';

            $f = new Zend_Filter_File_Rename(
                            array(
                                'target' => $imagen->nombre ,
                                'overwrite' => true
                            )
            );

            $upload->addFilter( $f );
            $imagen_new = array(
                'equipo_id' => $idEquipo
            );

            if ( $form->imagen->receive() )
                {

                $arrayTmp = array( 'imagen' => $target );

                $imagen = array_merge( $imagen , $imagen_new );

                $this->_imagen->saveImagen( $imagen , $id );
                $this->_helper->FlashMessenger(
                        $this->_translate->translate(
                                'Se inserto nueva imagen'
                        )
                );
                $this->_redirect( 'user/equipo/ver/id/' . $idEquipo );
                }
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    }

