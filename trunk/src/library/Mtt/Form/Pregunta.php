<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Pregunta
        extends Mtt_Form
    {

    protected $asunto;
    protected $formulacion;
    protected $respuesta;
    protected $copiaEmail;
    protected $submit;


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmPregunta' )
        ;

        // Elemento: Asunto
        $this->asunto = new Zend_Form_Element_Text(
                        'asunto'
        );
        $this->asunto->setLabel(
                ucwords(
                        $this->_translate->translate(
                                'asunto'
                        )
                )
        );
        $this->asunto->setAttrib( 'maxlength' , '120' );
        $this->asunto->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 120
                        )
        );
        $v->setMessage(
                $this->_translate->translate(
                        'Debe tener debe tener al menos'
                ) .
                " %min% " .
                $this->_translate->translate(
                        'caracteres'
                ) , Zend_Validate_StringLength::TOO_SHORT
        );
        $this->asunto->addValidator( $v );
        $this->addElement( $this->asunto );


        // Elemento: formulacion
        $this->formulacion = new Zend_Form_Element_TextArea(
                        'formulacion'
        );
        $this->formulacion->setLabel(
                ucwords(
                        $this->_translate->translate(
                                'pregunta'
                        )
                )
        );
        $this->formulacion->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array(
                            'min' => 20 , 'max' => 255
                        )
        );
        $this->formulacion->addValidator( $v );
        $this->formulacion->setAttrib('COLS' , '50');
        $this->formulacion->setAttrib('ROWS' , '10');
        $this->addElement( $this->formulacion );

        // Elemento: respuesta
        $this->respuesta = new Zend_Form_Element_Textarea(
                        'respuesta'
        );
        $this->respuesta
                ->setLabel(
                        ucwords(
                                $this->_translate->translate(
                                        'respuesta'
                                )
                        )
        );
        $this->respuesta->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 20 , 'max' => 255 )
        );
        $this->respuesta->addValidator( $v );
        $this->addElement( $this->respuesta );

        // Elemento: copiaEmail
        $this->copiaEmail = new Zend_Form_Element_Checkbox(
                        'copiaEmail'
        );
        $this->copiaEmail->setLabel(
                        $this->_translate->translate(
                                'Copy to email'
                        )
                )
                ->setAttrib( 'id' , 'copiaEmail' );
        $this->addElement( $this->copiaEmail );


        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        ucwords(
                                $this->_translate->translate( 'save' )
                        )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );

        $this->addElement( $this->submit );
        }


    }

