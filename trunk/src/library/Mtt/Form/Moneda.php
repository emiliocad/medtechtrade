<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Moneda
        extends Mtt_Formy
    {

        
    protected $nombre;
    protected $simbolo;
    protected $prefijo;
    protected $submit;
   

    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmMoneda' )
        ;

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
                $this->_translate->translate( 'El nombre del producto debe tener debe tener al menos' ) .
                " %min% " .
                $this->_translate->translate( 'caracteres' ) ,
                                              Zend_Validate_StringLength::TOO_SHORT
        );
        $this->nombre->addValidator( $v );
        //$this->addElement( $this->nombre );


        // Elemento: Simbolo
        $this->simbolo = new Zend_Form_Element_Text( 'simbolo' );
        $this->simbolo->setLabel( 
                ucwords( $this->_translate->translate( 'simbolo' ) ) . ': ' 
        );
        $this->simbolo->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 1 , 'max' => 5 )
        );
        $this->simbolo->addValidator( $v );
        //$this->addElement( $simbolo );

        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        ucwords($this->_translate->translate('save'))
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        //$this->addElement( $submit );
        
        
        $this->addElements(
                array(
                    $this->nombre ,
                    $this->simbolo,
                    $this->submit
                )
        );
        }


    }

