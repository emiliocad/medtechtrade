<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Pregunta
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmPregunta' )
        ;

        // Elemento: Asunto
        $asunto = new Zend_Form_Element_Text( 'asunto' );
        $asunto->setLabel( 'Asunto' );
        $asunto->setAttrib( 'maxlength' , '120' );
        $asunto->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 120 )
        );
        $v->setMessage(
                "La descripciion del asunto tener al menos
            %min% characters. '%value%' no cumple ese requisito" ,
                Zend_Validate_StringLength::TOO_SHORT
        );
        $asunto->addValidator( $v );
        $this->addElement( $asunto );


        // Elemento: formulacion
        $formulacion = new Mtt_Form_Element_Ckeditor( 'formulacion' );
        $formulacion->setLabel( 'Pregunta ' );
        $formulacion->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 20 , 'max' => 255 )
        );
        $formulacion->addValidator( $v );
        $this->addElement( $formulacion );

        // Elemento: respuesta
        $respuesta = new Zend_Form_Element_Textarea( 'respuesta' );
        $respuesta->setLabel( 'Respuesta ' );
        $respuesta->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 20 , 'max' => 255 )
        );
        $respuesta->addValidator( $v );
        $this->addElement( $respuesta );

        // Elemento: copiaEmail
        $copiaEmail = new Zend_Form_Element_Checkbox( 'copiaEmail' );
        $copiaEmail->setLabel( 'Copy to email' )
                ->setAttrib( 'id' , 'copiaEmail' );
        $this->addElement( $copiaEmail );


        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        $this->_translate->translate( 'Save' )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );

        $this->addElement( $submit );
        }


    }

