<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 */
class Mtt_Form_Categoria extends Zend_Form
    {

    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmCategoria' )
                ->setAttrib( 'enctype' , 'multipart/form-data' )
        ;

        $decorator = new Mtt_Form_Decorator_SimpleInput();

        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setLabel( 'Nombre *:' );
        $e->setRequired();
        $e->addValidator( new Zend_Validate_StringLength( array( 'min' => 2 , 'max' => 50 ) ) );
        $e->addValidator( new Zend_Validate_Alnum( true ) );
        $e->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'categoria' ,
                            'field' => 'nombre' ,
                        )
                )
        );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Text( 'title' );
        $e->setLabel( 'Title:' );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $e );

        $e = new Zend_Form_Element_File( 'thumbnail' );
        $e->setLabel( 'Upload an image:' );
        $e->setDestination( APPLICATION_PATH . '/../public/uploads/' );
        $f = new Zend_Filter_File_Rename( array( 'target' => '123.jpg' ) ); // Renombrar archivo
        $e->addFilter( $f );
        $e->addValidator( 'Count' , false , 1 ); // Solo 1 archivo
        $e->addValidator( 'Size' , false , 1024000 ); // limite de 1000K
        $e->addValidator( 'Extension' , false , 'jpg,png,gif' ); // solo JPEG, PNG, and GIFs
        $this->addElement( $e );



        $e = new Zend_Form_Element_Textarea( 'descripcion' );
        $e->setLabel( 'Descripcion *:' );
        $this->addElement( $e );


        //Submit
        $e = new Zend_Form_Element_Submit( 'submit' );
        $e->setAttrib( 'value' , 'Registrar' );
        $this->addElement( $e );
        }

    }

?>
