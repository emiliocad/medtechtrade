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
        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );

        //Traer datos del equipo
        $equipo = new Mtt_Models_Bussines_Equipo();
        $dataEquipo = $equipo->getProduct( $idEquipo );

        $this->view->assign( 'equipo' , $dataEquipo );

        //Imagenes subidas del equipo
        $imagenes = $equipo->getImagenes( $idEquipo );
        $this->view->assign( 'imagenes' , $imagenes );

        $form = new Mtt_Form_Imagen();

        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {

            $imagen = $form->getValues();

            $upload = $form->imagen->getTransferAdapter();
            $_imagen = new Mtt_Models_Bussines_Imagen();

            $slugger = new Mtt_Filter_Slug(
                            array(
                                'field' => 'nombre' ,
                                'model' => $_imagen
                            )
            );

            $target = $slugger->filter( $imagen['nombre'] ) . '.jpg';

            $f = new Zend_Filter_File_Rename(
                            array(
                                'target' => $target ,
                                'overwrite' => true
                            )
            );

            $upload->addFilter( $f );


            $imagen_new = array(
                'equipo_id' => $idEquipo ,
                'order' => count( $imagenes ) + 1 ,
                'imagen' => $target
            );

            if ( $form->imagen->receive() )
                {

                $serviceImage = new Mtt_Service_Image();
                $serviceImage->processImageAvata( $form->imagen->getFileName() ,
                                                  $target );
                $serviceImage->processImageEquipo( $form->imagen->getFileName() ,
                                                   $target );
                $serviceImage->processImageThumb( $form->imagen->getFileName() ,
                                                  $target );
                $serviceImage->processImageProduct( $form->imagen->getFileName() ,
                                                    $target );

                $imagen = array_merge( $imagen , $imagen_new );

                $this->_imagen->saveImagen( $imagen );
                $this->_helper->FlashMessenger(
                        $this->_translate->translate(
                                'se agrego la imagen al equipo'
                        )
                );
                $this->_redirect( 'user/imagen/nuevo/id/' . $idEquipo );
                }
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    }

