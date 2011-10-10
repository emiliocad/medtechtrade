<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Form_Categoria
        extends Mtt_Formy
    {
    
    protected $nombre;
    protected $title;
    protected $thumbnail;
    protected $descripcion;
    protected $published;
    protected $order;

    public function init()
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfig.ini' , 'upload'
                )
        ;
        $data = $_conf->toArray();

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmCategoria' )
                ->setAttrib( 'enctype' , 'multipart/form-data' )
        ;
        $this->addElementPrefixPath(
                'Mtt_Form_Decorator' , 'Mtt/Form/Decorator/' , 'decorator'
        );
        $decorator = new Mtt_Form_Decorator_SimpleInput();

        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( ucwords( $this->_translate->translate( 'nombre' ) ) . '*:' );
        $nombre->setRequired();
        $nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 2 ,
                            'max' => 50 ) )
        );
        //$nombre->addValidator( new Zend_Validate_Alnum( true ) );
        $nombre->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'categoria' ,
                            'field' => 'nombre' ,
                        )
                )
        );

        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $nombre );

        $title = new Zend_Form_Element_Text( 'title' );

        $title->setLabel(
                ucwords( $this->_translate->translate( 'title' ) ) . ':'
        );


        $this->addElement( $title );

        $thumbnail = new Zend_Form_Element_File( 'thumbnail' );
        $thumbnail->setValue( 'thumbnail' );
        $thumbnail->setLabel( $this->_translate->translate( 'Upload an image' ) . ':' );

        $target = $nombre->getValue();
        $thumbnail->setDestination(
                APPLICATION_PATH . '/../public/media/category/'
        );
        $thumbnail->addValidator( 'Count' , false , 1 );
        $thumbnail->addValidator( 'Size' , false , 1024000 )
                ->setValueDisabled( true );
        $thumbnail->addValidator(
                'Extension' , false , $data['extension']
        );

        $this->addElement(
                $thumbnail
        );



        $descripcion = new Mtt_Form_Element_Ckeditor(
                        'descripcion'
        );
        $descripcion->setLabel( ucwords( $this->_translate->translate( 'descripcion' ) ) . '*:' );

        $this->addElement( $descripcion );


        //Submit
        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setAttrib( 'value' ,
                            ucwords( $this->_translate->translate( 'registrar' ) ) )
                ->setAttrib( 'class' , 'button' )
                ->setAttrib( 'type' , 'submit' )
        ;
        $this->addElement( $submit );
        }


    }
