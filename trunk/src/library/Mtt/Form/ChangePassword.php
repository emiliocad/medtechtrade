<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 *
 */
class Mtt_Form_ChangePassword
        extends Zend_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmChangePassword' )
        ;
        $decorator = new Mtt_Form_Decorator_SimpleInput();

        $e = new Zend_Form_Element_Text( 'login' );
        $e->setLabel( 'Password:' );
        $e->setRequired();
        $e->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 20 )
                )
        );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Password( 'clave' );
        $e->setRequired();
        $e->setLabel( 'Password' );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $e );

        //Submit
        $decorator = new Mtt_Form_Decorator_SimpleButton();
        $e = new Zend_Form_Element_Submit( 'submit' );
        $e->setValue( 'Login' );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $e );
        }


    }
