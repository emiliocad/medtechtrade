<?php

class User_ImagenController extends Mtt_Controller_Action
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


    public function nuevoAction( )
        {
        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );
        
        //Traer datos del equipo
        $equipo = new Mtt_Models_Bussines_Equipo();
        $equipSelect = $equipo->getProduct($idEquipo);
        $this->view->assign( 'equipo' , $equipSelect );
        
        //Imagenes subidas del equipo
        $imagenes = $equipo->getImagenes( $idEquipo );
        $this->view->assign( 'imagenes' , $imagenes );
        
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
                ) . '_' . $id . '.jpg';

            $f = new Zend_Filter_File_Rename(
                        array(
                            'target' => $imagen->nombre ,
                            'overwrite' => true
                        )
            );

            $upload->addFilter( $f );             
            $imagen_new = array(
                'equipo_id' => $idEquipo,
                'order' => count($imagenes)+1
            );
        
            if ( $form->imagen->receive() )
                    {

                    $arrayTmp = array( 'imagen' => $target );

                    $imagen = array_merge( $imagen , $imagen_new );

                    $this->_imagen->saveImagen( $imagen , $id );
                    $this->_helper->FlashMessenger( 'Se inserto nueva imagen' );
                    $this->_redirect( 'user/equipo/ver/id/'.$idEquipo );
                    }
        
            
            }
            $this->view->assign( 'frmRegistrar' , $form );
        }

    }

