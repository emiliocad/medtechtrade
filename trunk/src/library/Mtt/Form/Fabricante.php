<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Fabricante
        extends Mtt_Formy
    {

    protected $nombre;
    protected $submit;
    
    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmFabricante' )
        ;

        // Elemento: Nombre
        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setLabel( 
                $this->_translate->translate('nombre' )
        );
        $this->nombre->setAttrib( 'maxlength' , '50' );
        $this->nombre->setRequired( true );
        $this->nombre->addValidator( new Zend_Validate_Db_NoRecordExists( array(
                    'table' => 'fabricantes' ,
                    'field' => 'nombre' ,
                        ) ) );
        $this->nombre->addValidator( 
                new Zend_Validate_StringLength( 
                        array( 'min' => 2 , 'max' => 25 ) 
                ) 
        );

        //$this->addElement( $e );

        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        $this->_translate->translate( 'guardar' )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        //$this->addElement( $submit );
        $this->addElements(
                array(
                    $this->nombre,
                    $this->submit)
                );
        }


    }
