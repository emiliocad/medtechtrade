<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//TODO Crear Translate para Zend Form
class Mtt_Form_Categoria
        extends Zend_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmCategoria' )
                ->setAttrib( 'enctype' , 'multipart/form-data' )
        ;

        $decorator = new Mtt_Form_Decorator_SimpleInput();

        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( 'Nombre *:' );
        $nombre->setRequired();
        $nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 2 ,
                            'max' => 50 ) )
        );
        $nombre->addValidator( new Zend_Validate_Alnum( true ) );
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
        $title->setLabel( 'Title:' );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $title );

        $thumbnail = new Zend_Form_Element_File( 'thumbnail' );
        $thumbnail->setLabel( 'Upload an image:' );
        $thumbnail->setDestination(
                APPLICATION_PATH . '/../public/uploads/' );
        $f = new Zend_Filter_File_Rename( array( 'target' => '123.jpg' ) ); // Renombrar archivo
        $thumbnail->addFilter( $f );
        $thumbnail->addValidator( 'Count' , false , 1 ); // Solo 1 archivo
        $thumbnail->addValidator( 'Size' , false , 1024000 ); // limite de 1000K
        $thumbnail->addValidator( 'Extension' , false , 'jpg,png,gif' ); // solo JPEG, PNG, and GIFs
        $this->addElement( $thumbnail
        );



        $descripcion = new Zend_Form_Element_Textarea( 'descripcion' );
        $descripcion->setLabel( 'Descripcion *:' );
        $this->addElement( $descripcion );


        //Submit
        $submit = new Zend_Form_Element_Submit( 'submit' );
        $submit->setAttrib( 'value' , 'Registrar' );
        $this->addElement( $submit );
        }


    }
