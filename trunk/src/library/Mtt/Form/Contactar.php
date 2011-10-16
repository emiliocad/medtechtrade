<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Contactar
        extends Mtt_Form
    {

    protected $nombre;
    protected $direccion;
    protected $email;
    protected $codPostal;
    protected $ciudad;
    protected $paises_id;
    protected $telefono;
    protected $comentario;
    protected $submit;


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmContactar' )
        ;

        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setRequired();
        $this->nombre->setLabel(
                ucwords( $this->_translate->translate( 'name' ) ) . ':'
        );
        $this->nombre->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5
                            ,
                            'max' => 25 )
                )
        );
        $this->addElement( $this->nombre );

        $this->direccion = new Zend_Form_Element_Text( 'direccion' );
        $this->direccion->setRequired();
        $this->direccion->setLabel(
                ucwords( $this->_translate->translate( 'address' ) ) . ':'
        );
        $this->direccion->addValidator( new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 25 )
                )
        );
        $this->addElement( $this->direccion );
        /* email */
        $this->email = new Zend_Form_Element_Text( 'email' );
        $this->email->setRequired();

        $this->email->setLabel(
                $this->_translate->translate( 'email' ) . ':'
        );
        $this->email->addValidator( new Zend_Validate_EmailAddress() );
        $this->addElement( $this->email );
        /* end email */

        $this->codPostal = new Zend_Form_Element_Text( 'codpostal' );
        $this->codPostal->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->codPostal->setLabel(
                ucwords( $this->_translate->translate( 'codigo postal' ) ) . ':'
        );
        $this->addElement( $this->codPostal );


        $this->ciudad = new Zend_Form_Element_Text( 'ciudad' );
        $this->ciudad->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->ciudad->setLabel(
                ucwords( $this->_translate->translate( 'ciudad' ) ) . ':'
        );
        $this->addElement( $this->ciudad );


        $this->paises_id = new Zend_Form_Element_Select( 'paises_id' );
        $this->paises_id->setLabel(
                ucwords( $this->_translate->translate( 'pais' ) ) . ':'
        );
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $this->paises_id->addMultiOption( -1 ,
                                          ucwords( $this->_translate->translate( 'pais' ) ) . ':'
        );
        $this->paises_id->addMultiOptions( $values );
        $this->addElement( $this->paises_id );
        $this->paises_id->addValidator( new Zend_Validate_InArray( array_keys( $values ) ) );



        $this->telefono = new Zend_Form_Element_Text( 'telefono' );
        $this->telefono->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->telefono->setLabel(
                ucwords( $this->_translate->translate( 'telefono' ) ) . ':'
        );
        $this->telefono->addValidators( array(
            array(
                'validator' => 'Regex' ,
                'breakChainOnFailure' => true ,
                'options' => array(
                    'pattern' => '/^[+]?[-\d() .]*$/i' ,
                    'messages' => array(
                        Zend_Validate_Regex::NOT_MATCH =>
                        'ingrese un numero telefonico correcto'
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
        $this->addElement( $this->telefono );

        $this->comentario = new Zend_Form_Element_Textarea( 'comentario' );
        $this->comentario->setRequired()
                ->setLabel(
                        ucwords( $this->_translate->translate( 'comentario' ) ) . ':'
                )->setAttrib( 'rows' , 10 )
                ->setAttrib( 'cols' , 50 )
        ;

        $this->addElement( $this->comentario );

        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setAttrib( 'value' ,
                                  ucwords(
                                $this->_translate->translate( 'enviar' )
                        )
                )
                ->setAttrib( 'class' , 'button' )
                ->setAttrib( 'type' , 'submit' )
        ;
        $this->addElement( $this->submit );
        }


    }

