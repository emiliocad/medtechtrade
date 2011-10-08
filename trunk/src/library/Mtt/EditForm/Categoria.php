<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO Crear Translate para Zend Form
class Mtt_EditForm_Categoria
        extends Mtt_Form_Categoria
    {

    protected $nombre;
    protected $title;
    protected $thumbnail;
    protected $descripcion;
    protected $submit;


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

        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setLabel( ucwords( $this->_translate->translate( 'nombre' ) ) . '*:' );
        $this->nombre->setRequired();
        $this->nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 2 ,
                            'max' => 50 ) )
        );
        //$nombre->addValidator( new Zend_Validate_Alnum( true ) );
        $this->nombre->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'categoria' ,
                            'field' => 'nombre' ,
                        )
                )
        );

        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $this->nombre );

        $this->title = new Zend_Form_Element_Text( 'title' );

        $this->title->setLabel(
                ucwords( $this->_translate->translate( 'title' ) ) . ':'
        );


        $this->addElement( $this->title );

        $this->thumbnail = new Zend_Form_Element_File( 'thumbnail' );
        $this->thumbnail->setValue( 'thumbnail' );
        $this->thumbnail->setLabel( $this->_translate->translate( 'Upload an image' ) . ':' );

        $target = $$this->nombre->getValue();

        $this->thumbnail->setDestination(
                APPLICATION_PATH . '/../public/media/category/'
        );
        $this->thumbnail->addValidator( 'Count' , false , 1 );
        $this->thumbnail->addValidator( 'Size' , false , 1024000 )
                ->setValueDisabled( true );
        $this->thumbnail->addValidator(
                'Extension' , false , $data['extension']
        );

        $this->addElement(
                $this->thumbnail
        );



        $this->descripcion = new Mtt_Form_Element_Ckeditor(
                        'descripcion'
        );
        $this->descripcion->setLabel( ucwords(
                        $this->_translate->translate( 'descripcion' )
                ) . '*:'
        );

        $this->addElement( $this->descripcion );


        //Submit
        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setAttrib( 'value' ,
                                  ucwords(
                                $this->_translate->translate( 'registrar' )
                        )
                )
                ->setAttrib( 'class' , 'button' )
                ->setAttrib( 'type' , 'submit' )
        ;
        $this->addElement( $this->submit );
        }


    }
