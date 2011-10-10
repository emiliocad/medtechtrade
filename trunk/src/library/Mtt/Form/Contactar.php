<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Contactar
        extends Mtt_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmContactar' )
        ;

        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
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

        $e = new Zend_Form_Element_Text( 'direccion' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                ucwords( $this->_translate->translate( 'address' ) ) . ':'
        );
        $e->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 25 )
                )
        );
        $this->addElement( $e );
        /* email */
        $e = new Zend_Form_Element_Text( 'email' );
        $e->setRequired();

        $e->setLabel(
                $this->_translate->translate( 'email' ) . ':'
        );
        $e->addValidator( new Zend_Validate_EmailAddress() );
        $this->addElement( $e );
        /* end email */

        $e = new Zend_Form_Element_Text( 'codpostal' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                ucwords( $this->_translate->translate( 'codigo postal' ) ) . ':'
        );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Text( 'ciudad' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                ucwords( $this->_translate->translate( 'ciudad' ) ) . ':'
        );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Select( 'paises_id' );
        $e->setLabel(
                ucwords( $this->_translate->translate( 'pais' ) ) . ':'
        );
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $e->addMultiOption( -1 ,
                            ucwords( $this->_translate->translate( 'paises' ) ) . ':'
        );
        $e->addMultiOptions( $values );
        $this->addElement( $e );
        $e->addValidator( new Zend_Validate_InArray( array_keys( $values ) ) );



        $e = new Zend_Form_Element_Text( 'telefono' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                ucwords( $this->_translate->translate( 'telefono' ) ) . ':'
        );
        $e->addValidators( array(
            array(
                'validator' => 'Regex' ,
                'breakChainOnFailure' => true ,
                'options' => array(
                    'pattern' => '/^[+]?[-\d() .]*$/i' ,
                    'messages' => array(
                        Zend_Validate_Regex::NOT_MATCH =>
                        'ingre un numero telefonico correcto'
                    )
                )
            ) ,
            array(
                'validator' => 'StringLength' ,
                'breakChainOnFailure' => true ,
                'options' => array(
                    'min' => 6
                )
            )
        ) );
        $this->addElement( $e );


        $comentario = new Zend_Form_Element_Textarea( 'comentario' );
        $comentario->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $comentario->setLabel(
                ucwords( $this->_translate->translate( 'comentario' ) ) . ':'
        );
        $this->addElement( $comentario );

        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setAttrib( 'value' ,
                            ucwords(
                                $this->_translate->translate( 'enviar' )
                        )
                )
                ->setAttrib( 'class' , 'button' )
                ->setAttrib( 'type' , 'submit' )
        ;
        $this->addElement( $submit );
        }


    }

