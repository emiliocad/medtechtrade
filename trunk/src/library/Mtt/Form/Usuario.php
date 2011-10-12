<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO crear decoradores para este formulario
class Mtt_Form_Usuario
        extends Mtt_Formy
    {
    
    protected $tratamiento;
    protected $nombre;
    protected $apellido;
    protected $login;
    protected $email;
    protected $clave;
    protected $clave2;
    protected $direccion;
    protected $codPostal;
    protected $ciudad;
    protected $paises;
    protected $rol;
    protected $institucion;
    protected $telefono;
    protected $fax;
    protected $submit;


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmRegistrar' )
        ;
        
        $this->tratamiento = new Zend_Form_Element_Select( 'tratamiento' );
        $this->tratamiento->setRequired();

        $_tratam = new Mtt_Models_Bussines_Usuario();
        $values = $_tratam->getTratamientosUsuario();
        $this->tratamiento->addMultiOptions( $values );
        //$this->addElement( $e );
        $this->tratamiento->addValidator( new Zend_Validate_InArray(
                        array_keys( $values )
                )
        );

        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->nombre->setLabel(
                ucwords(
                        $this->_translate->translate( 'nombre' )
                ) . ':'
        );
        $this->nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 25 )
                )
        );


        $this->apellido = new Zend_Form_Element_Text( 'apellido' );
        $this->apellido->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->apellido->setLabel(
                ucwords(
                        $this->_translate->translate( 'apellido' )
                ) . ':'
        );
        $this->apellido->addValidator(
                new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 25
                        )
                )
        );
        //$this->addElement( $e );

        $this->email = new Zend_Form_Element_Text( 'email' );
        $this->email->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->email->setLabel(
                ucwords(
                        $this->_translate->translate( 'email' )
                ) . ':'
        );
        $this->email->addValidator( new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'usuario' ,
                            'field' => 'email' )
                )
        );
        $this->email->addValidator(
                new Zend_Validate_EmailAddress()
        );
        //$this->addElement( $e );

        $this->login = new Zend_Form_Element_Text( 'login' );
        $this->login->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->login->setLabel(
                ucwords(
                        $this->_translate->translate( 'login' )
                ) . ':'
        );
        $this->login->addValidator( new Zend_Validate_Alnum() );
        $this->login->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'usuario' ,
                            'field' => 'login' ,
                        )
                )
        );
        $this->login->addValidator(
                new Zend_Validate_StringLength(
                        array(
                            'min' => 5 , 'max' => 25
                        )
                )
        );
        //$this->addElement( $e );

        $this->clave = new Zend_Form_Element_Password( 'clave' );
        $this->clave->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->clave->setLabel(
                ucwords(
                        $this->_translate->translate( 'password' )
                ) . ':'
        );
        //$this->addElement( $e );

        $this->clave2 = new Zend_Form_Element_Password( 'clave_2' );
        $this->clave2->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->clave2->setLabel(
                ucwords(
                        $this->_translate->translate( 'confirmar password' )
                ) . ':'
        );
        $this->clave2->addValidator(
                new Mtt_Validate_PasswordConfirmation()
        );
        //$this->addElement( $e );


        $this->direccion = new Zend_Form_Element_Text( 'direccion' );
        $this->direccion->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->direccion->setLabel(
                ucwords(
                        $this->_translate->translate( 'direccion' )
                ) . ':'
        );
        //$this->addElement( $e );


        $this->codPostal = new Zend_Form_Element_Text( 'codpostal' );
        $this->codPostal->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->codPostal->setLabel(
                ucwords(
                        $this->_translate->translate( 'codigo postal' )
                ) . ':'
        );
        //$this->addElement( $e );


        $this->ciudad = new Zend_Form_Element_Text( 'ciudad' );
        $this->ciudad->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->ciudad->setLabel(
                ucwords(
                        $this->_translate->translate( 'ciudad' )
                ) . ':'
        );
        //$this->addElement( $e );


        $this->paises = new Zend_Form_Element_Select( 'paises_id' );
        $this->paises->setRequired();
        $this->paises->setLabel(
                '* ' . $this->_translate->translate( 'Escoger pais' )
        );
        $this->paises->setRequired();
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $this->paises->addMultiOption( -1 , '--- Paises ---' );
        $this->paises->addMultiOptions( $values );
        //$this->addElement( $e );
        $this->paises->addValidator( new Zend_Validate_InArray(
                        array_keys( $values )
                )
        );

        $this->rol = new Zend_Form_Element_Select( 'tipousuario_id' );
        $this->rol->setRequired();
        $this->rol->setLabel(
                '* :' . $this->_translate->translate( 'tipo de usuario' )
        );
        $_tipoUsuario = new Mtt_Models_Bussines_TipoUsuario();
        $values = $_tipoUsuario->getComboValues();
        $this->rol->addMultiOption( -1 , '--- Rol de Usario ---' );
        $this->rol->addMultiOptions( $values );
        //$this->addElement( $e );
        $this->rol->addValidator( new Zend_Validate_InArray(
                        array_keys( $values )
                )
        );



        $this->institucion = new Zend_Form_Element_Text( 'institucion' );
        $this->institucion->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->institucion->setLabel(
                ucwords(
                        $this->_translate->translate( 'institucion' )
                ) . ':'
        );
        //$this->addElement( $e );
        
        $this->telefono = new Zend_Form_Element_Text( 'telefono' );
        //$this->telefono->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->telefono->setLabel(
                ucwords(
                        $this->_translate->translate( 'telefono' )
                ) . ':'
        );
        
        $this->fax = new Zend_Form_Element_Text( 'fax' );
        //$this->fax->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->fax->setLabel(
                ucwords(
                        $this->_translate->translate( 'fax' )
                ) . ':'
        );

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



        $this->addElements(
                array(
                    $this->tratamiento,
                    $this->nombre ,
                    $this->apellido ,
                    $this->login ,
                    $this->email ,
                    $this->clave ,
                    $this->clave2 ,
                    $this->direccion ,
                    $this->codPostal ,
                    $this->ciudad ,
                    $this->paises ,
                    $this->rol ,
                    $this->institucion ,
                    $this->telefono,
                    $this->fax,
                    $this->submit
                )
        );
        }


    }

?>
