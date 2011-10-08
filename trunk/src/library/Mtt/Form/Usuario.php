<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO crear decoradores para este formulario
class Mtt_Form_Usuario
        extends Mtt_Formy
    {

    protected $nombre;


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmRegistrar' )
        ;

        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->nombre->setLabel( ucwords( $this->_translate->translate( 'nombre' ) ) . ':' );
        $this->nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 25 )
                )
        );


        $apellido = new Zend_Form_Element_Text( 'apellido' );
        $apellido->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $apellido->setLabel( ucwords( $this->_translate->translate( 'apellido' ) ) . ':' );
        $apellido->addValidator( new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 25 )
                )
        );
        //$this->addElement( $e );

        $email = new Zend_Form_Element_Text( 'email' );
        $email->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $email->setLabel( ucwords( $this->_translate->translate( 'email' ) ) . ':' );
        $email->addValidator( new Zend_Validate_EmailAddress() );
        //$this->addElement( $e );

        $login = new Zend_Form_Element_Text( 'login' );
        $login->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $login->setLabel( ucwords( $this->_translate->translate( 'login' ) ) . ':' );
        $login->addValidator( new Zend_Validate_Alnum() );
        $login->addValidator( new Zend_Validate_Db_NoRecordExists( array(
                    'table' => 'usuario' ,
                    'field' => 'login' ,
                        ) ) );
        $login->addValidator( new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 25 )
                )
        );
        //$this->addElement( $e );

        $clave = new Zend_Form_Element_Password( 'clave' );
        $clave->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $clave->setLabel( ucwords( $this->_translate->translate( 'password' ) ) . ':' );
        //$this->addElement( $e );

        $clave2 = new Zend_Form_Element_Password( 'clave_2' );
        $clave2->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $clave2->setLabel( ucwords( $this->_translate->translate( 'confirmar password' ) ) . ':' );
        $clave2->addValidator( new Mtt_Validate_PasswordConfirmation() );
        //$this->addElement( $e );


        $direccion = new Zend_Form_Element_Text( 'direccion' );
        $direccion->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $direccion->setLabel( ucwords( $this->_translate->translate( 'direccion' ) ) . ':' );
        //$this->addElement( $e );


        $codPostal = new Zend_Form_Element_Text( 'codpostal' );
        $codPostal->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $codPostal->setLabel( ucwords( $this->_translate->translate( 'codigo postal' ) ) . ':' );
        //$this->addElement( $e );


        $ciudad = new Zend_Form_Element_Text( 'ciudad' );
        $ciudad->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $ciudad->setLabel( ucwords( $this->_translate->translate( 'ciudad' ) ) . ':' );
        //$this->addElement( $e );


        $paises = new Zend_Form_Element_Select( 'paises_id' );
        $paises->setRequired();
        $paises->setLabel( '* ' . $this->_translate->translate( 'Escoger pais' ) );
        $paises->setRequired();
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $paises->addMultiOption( -1 , '--- Paises ---' );
        $paises->addMultiOptions( $values );
        //$this->addElement( $e );
        $paises->addValidator( new Zend_Validate_InArray(
                        array_keys( $values )
                )
        );

        $rol = new Zend_Form_Element_Select( 'tipousuario_id' );
        $rol->setRequired();
        $rol->setLabel( '* :' . $this->_translate->translate( 'tipo de usuario' ) );
        $_tipoUsuario = new Mtt_Models_Bussines_TipoUsuario();
        $values = $_tipoUsuario->getComboValues();
        $rol->addMultiOption( -1 , '--- Rol de Usario ---' );
        $rol->addMultiOptions( $values );
        //$this->addElement( $e );
        $rol->addValidator( new Zend_Validate_InArray(
                        array_keys( $values )
                )
        );



        $institucion = new Zend_Form_Element_Text( 'institucion' );
        $institucion->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $institucion->setLabel( ucwords( $this->_translate->translate( 'institucion' ) ) . ':' );
        //$this->addElement( $e );

        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        ucwords( $this->_translate->translate( 'save' ) )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );



        $this->addElements(
                array(
                    $this->nombre ,
                    $apellido ,
                    $email ,
                    $login ,
                    $clave ,
                    $clave2 ,
                    $direccion ,
                    $codPostal ,
                    $ciudad ,
                    $paises ,
                    $rol ,
                    $institucion ,
                    $submit
                )
        );
        }


    }

?>
