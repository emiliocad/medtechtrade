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
        $decorator = new Mtt_Form_Decorator_SimpleInput();

        $e = new Zend_Form_Element_Text( 'login' );
        $e->setLabel( 'Username' );
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

        $e = new Zend_Form_Element_Checkbox('remember');
        $e->setLabel('Remember me');
        $this->addElement( $e );
                 
        
        //Submit
        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        $this->_translate->translate( 'Login' )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        $this->addElement( $submit );
        }


    }
