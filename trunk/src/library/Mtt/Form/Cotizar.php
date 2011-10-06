<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Cotizar
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmCotizar' )
        ;

        //Nombre
        $decorator = new Mtt_Form_Decorator_SimpleInput();
        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'nombre'
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

        /* Organizacion */
        $e = new Zend_Form_Element_Text( 'organizacion' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'organizacion'
                )
        );
        $e->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 25 )
                )
        );
        $this->addElement( $e );


        /* Direccion */
        $e = new Zend_Form_Element_Text( 'direccion' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'direccion'
                )
        );
        $e->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 25 )
                )
        );
        $this->addElement( $e );

        /* Cod. Postal */
        $e = new Zend_Form_Element_Text( 'codpostal' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'codigo postal'
                )
        );
        $this->addElement( $e );

        /*  Ciudad  */
        $e = new Zend_Form_Element_Text( 'ciudad' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'ciudad'
                )
        );
        $this->addElement( $e );

        /* Pais */
        $e = new Zend_Form_Element_Select( 'paises_id' );
        $e->setLabel(
                $this->_translate->translate(
                        'pais'
                )
        );
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $e->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'paises'
                )
        );
        $e->addMultiOptions( $values );
        $this->addElement( $e );
        $e->addValidator( new Zend_Validate_InArray( array_keys( $values ) ) );

        /* email */
        $e = new Zend_Form_Element_Text( 'email' );
        $e->setRequired();

        $e->setLabel(
                $this->_translate->translate(
                        'email'
                )
        );
        $e->addValidator( new Zend_Validate_EmailAddress() );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Text( 'asunto' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'asunto'
                )
        );
        $this->addElement( $e );


        $e = new Zend_Form_Element_TextArea( 'mensaje' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
            $this->_translate->translate(
                'mensaje'
        ));
        $e->setAttrib('COLS' , '40');
        $e->setAttrib('ROWS' , '4');
        
        $this->addElement( $e );

        $e = new Zend_Form_Element_Checkbox( 'toemail' );
        $e->setLabel( $this->_translate->translate(
                                'Envie una copia a su correo' ) )
                ->setAttrib( 'id' , 'toemail' );
        $this->addElement( $e );

        $this->addElement( 'submit' ,
                           $this->_translate->translate(
                        'Submit'
                )
        );
        }


    }

