<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO Crear Translate para Zend Form
class Mtt_Form_Test
        extends Mtt_Formy
    {


    public function init()
        {

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmCategoria' )
        ;

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
