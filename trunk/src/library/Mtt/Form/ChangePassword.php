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
        $clave = new Zend_Form_Element_Password( 'clave' );
        $clave->setLabel( 'New Password:' );
        $clave->setRequired();
        $clave->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 20 )
                )
        );

        $this->addElement( $clave );

        $clave2 = new Zend_Form_Element_Password( 'clave2' );
        $clave2->setRequired();
        $clave2->setLabel( 'Password' );
        $clave2->addValidator( new Mtt_Validate_PasswordConfirmation() );
        
        $this->addElement( $clave2 );

        //Submit
        $submit = new Zend_Form_Element_Submit( 'submit' );
        $submit->setValue( 'Change Password' );
        $submit->setAttrib( 'class' , 'button' );
        //$e->setDecorators( array( $decorator ) );
        $this->addElement( $submit );
        }


    }