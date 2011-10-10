<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Pais
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmPais' )
        ;

        //$decorator = new Mtt_Form_Decorator_SimpleInput();

        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( ucwords( $this->_translate->translate( 'nombre' ) ) . '*:' );
        $nombre->setRequired();
        $nombre->addValidator(
                new Zend_Validate_StringLength(
                        array(
                            'min' => 2 ,
                            'max' => 50
                        )
                )
        );
        $nombre->addValidator( new Zend_Validate_Alnum( true ) );
        $nombre->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'paises' ,
                            'field' => 'nombre' ,
                        )
                )
        );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $nombre );

        $code = new Zend_Form_Element_Text( 'code' );
        $code->setLabel( ucwords( $this->_translate->translate( 'code' ) ) . ':' );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $code );

        //Submit
        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        ucwords( $this->_translate->translate( 'save' ) )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );

        $this->addElement( $submit );
        }


    }

