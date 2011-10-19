<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_ContactarAdmin
        extends Mtt_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmContactarAdmin' )
        ;

       
        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setRequired();
        $e->setLabel(
                ucwords( $this->_translate->translate( 'name' ) ) . ':'
        );
        $e->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5
                            ,
                            'max' => 25 )
                )
        );
        $this->addElement( $e );

        
        /* email */
        $email = new Zend_Form_Element_Text( 'email' );
        $email->setRequired();

        $email->setLabel(
                ucwords( $this->_translate->translate( 'email' ) ) . ':'
        );
        $email->addValidator( new Zend_Validate_EmailAddress() );
        $this->addElement( $email );
        /* end email */

        $asunto = new Zend_Form_Element_Text( 'asunto' );
        $asunto->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $asunto->setLabel(
                ucwords( $this->_translate->translate( 'asunto' ) ) . ':'
        );
        $asunto->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5
                            ,
                            'max' => 25 )
                )
        );
        $this->addElement( $asunto );


        $e = new Zend_Form_Element_Textarea( 'comentario' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                ucwords( $this->_translate->translate( 'comentario' ) ) . ':'
        );
        $this->addElement( $e );

        $this->addElement( 'submit' ,
                           $this->_translate->translate(
                        'Submit'
                )
        );
        }


    }

