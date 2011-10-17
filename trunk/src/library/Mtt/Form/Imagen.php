<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Imagen
        extends Mtt_Form
    {

    protected $nombre;
    protected $imagen;
    protected $descripcion;
    protected $submit;


    public function __construct( $translator = null )
        {
        parent::__construct( $translator );
        }


    public function init()
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfig.ini' , 'upload'
                )
        ;
        $data = $_conf->toArray();

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmImagen' )
                ->setAttrib( 'enctype' , 'multipart/form-data' );

        // Nombre
        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setLabel( ucwords(
                        $this->_translate->translate( 'nombre' ) ) . '*:'
        );
        $this->nombre->setRequired();
        $this->nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 2 ,
                            'max' => 50 ) )
        );
        $this->addElement( $this->nombre );
//        $nombre->addValidator(
//                new Zend_Validate_Db_NoRecordExists(
//                        array(
//                            'table' => 'categoria' ,
//                            'field' => 'nombre' ,
//                        )
//                )
//        );
        //Imagen
        $this->imagen = new Zend_Form_Element_File( 'imagen' );
        $this->imagen->setValue( 'imagen' );
        $this->imagen->setLabel(
                $this->_translate->translate( 'Upload an image' ) . ':'
        );
        $this->imagen->setRequired();
        $target = $this->nombre->getValue();
        $this->imagen->setDestination(
                APPLICATION_PATH . '/../public/media/catalog/product'
        );

        $this->imagen->addValidator( 'Count' , false , 1 );
        $this->imagen->addValidator( 'Size' , false , 1024000 )
                ->setValueDisabled( true );
        $this->imagen->addValidator(
                'Extension' , false , $data['extension']
        );

        $this->addElement(
                $this->imagen
        );

        // Elemento: Nombre
        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setLabel(
                ucwords( $this->_translate->translate( 'nombre' ) )
        );
        $this->nombre->setAttrib( 'maxlength' , '50' );
        $this->nombre->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 50 )
        );
        $v->setMessage(
                "El nombre del producto debe tener debe tener al menos
            %min% characters. '%value%' no cumple ese requisito" ,
                Zend_Validate_StringLength::TOO_SHORT
        );
        $this->nombre->addValidator( $v );
        $this->addElement( $this->nombre );

        // Elemento: Descripcion
        $this->descripcion = new Zend_Form_Element_Textarea( 'descripcion' );
        $this->descripcion->setLabel(
                ucwords( $this->_translate->translate( 'descripcion' ) ) . ':'
        );
        $this->descripcion->setAttrib( 'maxlength' , '50' )
                ->setAttrib( 'rows' , '10' )
                ->setAttrib( 'cols' , '50' );
        $this->descripcion->setRequired( false );
        $this->addElement( $this->descripcion );

        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        ucwords( $this->_translate->translate( 'save' ) )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        $this->addElement( $this->submit );
        }


    }

