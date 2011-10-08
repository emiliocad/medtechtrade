<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Moneda
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmMoneda' )
        ;

        // Elemento: Nombre
        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( ucwords( $this->_translate->translate( 'nombre' ) ) );
        $nombre->setAttrib( 'maxlength' , '50' );
        $nombre->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 50 )
        );
        $v->setMessage(
                $this->_translate->translate( 'El nombre del producto debe tener debe tener al menos' ) .
                " %min% " .
                $this->_translate->translate( 'caracteres' ) ,
                                              Zend_Validate_StringLength::TOO_SHORT
        );
        $nombre->addValidator( $v );
        $this->addElement( $nombre );


        // Elemento: Simbolo
        $simbolo = new Zend_Form_Element_Text( 'simbolo' );
        $simbolo->setLabel( ucwords( $this->_translate->translate( 'simbolo' ) ) . ': ' );
        $simbolo->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 1 , 'max' => 5 )
        );
        $simbolo->addValidator( $v );
        $this->addElement( $simbolo );

        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        ucwords($this->_translate->translate('save'))
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        $this->addElement( $submit );
        }


    }

