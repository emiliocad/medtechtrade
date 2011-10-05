<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 *
 */
class Mtt_Form_Login
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmLogin' )
        ;


        $login = new Zend_Form_Element_Text( 'login' );
        $login->setLabel(
                $this->_translate->translate(
                        'username'
                )
        );
        $login->setRequired();
        $login->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 20 )
                )
        );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $login );

        $clave = new Zend_Form_Element_Password( 'clave' );
        $clave->setRequired();
        $clave->setLabel(
                $this->_translate->translate(
                        'password'
                )
        );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $clave );

        $login = new Zend_Form_Element_Checkbox( 'remember' );
        $login->setLabel( $this->_translate->translate( 'Remember me' ) );
        $this->addElement( $login );


        //Submit
        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        ucwords($this->_translate->translate( 'login' ))
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        $this->addElement( $submit );
        }


    }
