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

        $decorator = new Mtt_Form_Decorator_SimpleInput();
        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'Name:'
                )
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
                $this->_translate->translate(
                        'Address:'
                )
        );
        $e->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 25 )
                )
        );
        $this->addElement( $e );
        /* email */
        $e = new Zend_Form_Element_Text( 'email' );
        $e->addValidator( new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'usuario' ,
                            'field' => 'email' )
                )
        );
        $e->setRequired();

        $e->setLabel(
                $this->_translate->translate(
                        'Email:'
                )
        );
        $e->addValidator( new Zend_Validate_EmailAddress() );
        $this->addElement( $e );
        /* end email */

        $e = new Zend_Form_Element_Text( 'codpostal' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'Codigo Postal:'
                )
        );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Text( 'ciudad' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'City:'
                )
        );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Select( 'paises_id' );
        $e->setLabel(
                $this->_translate->translate(
                        'Country:'
                )
        );
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $e->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'Countries:'
                )
        );
        $e->addMultiOptions( $values );
        $this->addElement( $e );
        $e->addValidator( new Zend_Validate_InArray( array_keys( $values ) ) );



        $e = new Zend_Form_Element_Text( 'telefono' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'Telephone:'
                )
        );
        $this->addElement( $e );
        
        
        $e = new Zend_Form_Element_TextArea( 'comentario' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'Comment:'
                )
        );
        $this->addElement( $e );

        $this->addElement( 'submit' ,
                           $this->_translate->translate(
                        'Submit'
                )
        );
        }


    }

