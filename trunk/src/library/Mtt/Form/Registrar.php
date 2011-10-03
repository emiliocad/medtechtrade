<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Registrar
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmRegistrar' )
        ;

        $decorator = new Mtt_Form_Decorator_SimpleInput();
        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Nombre:' );
        $e->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5
                            ,
                            'max' => 25 )
                )
        );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Text( 'apellido' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Apellido:' );
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

        $e->setLabel( 'Email:' );
        $e->addValidator( new Zend_Validate_EmailAddress() );
        $this->addElement( $e );
        /* end email */
        $e = new Zend_Form_Element_Text( 'login' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Login:' );
        $e->addValidator( new Zend_Validate_Alnum() );
        $e->addValidator( new Zend_Validate_Db_NoRecordExists( array(
                    'table' => 'usuario' ,
                    'field' => 'login' ,
                        ) ) );
        $e->addValidator( new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 25 ) ) );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Password( 'clave' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Password:' );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Password( 'clave_2' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Confirmación Password:' );
        $e->addValidator( new Mtt_Validate_PasswordConfirmation() );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Text( 'direccion' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Direccion:' );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Text( 'codpostal' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Cod. Postal:' );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Text( 'ciudad' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Ciudad:' );
        $this->addElement( $e );


        $e = new Zend_Form_Element_Select( 'paises_id' );
        $e->setLabel( 'Pais' );
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $e->addMultiOption( -1 , '--- Paises ---' );
        $e->addMultiOptions( $values );
        $this->addElement( $e );
        $e->addValidator( new Zend_Validate_InArray( array_keys( $values ) ) );



        $e = new Zend_Form_Element_Text( 'institucion' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel( 'Institucion:' );
        $this->addElement( $e );

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

