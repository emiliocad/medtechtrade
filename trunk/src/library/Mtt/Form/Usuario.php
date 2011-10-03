<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO crear decoradores para este formulario
class Mtt_Form_Usuario
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmRegistrar' )
        ;

        $decorator = new Mtt_Form_Decorator_SimpleInput();
        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $nombre->setLabel( 'Nombre:' );
        $nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 25 )
                )
        );


        $apellido = new Zend_Form_Element_Text( 'apellido' );
        $apellido->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $apellido->setLabel( 'Apellido:' );
        $apellido->addValidator( new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 25 )
                )
        );
        //$this->addElement( $e );

        $email = new Zend_Form_Element_Text( 'email' );
        $email->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $email->setLabel( 'Email:' );
        $email->addValidator( new Zend_Validate_EmailAddress() );
        //$this->addElement( $e );

        $login = new Zend_Form_Element_Text( 'login' );
        $login->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $login->setLabel( 'Login:' );
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
        $clave->setLabel( 'Password:' );
        //$this->addElement( $e );

        $clave2 = new Zend_Form_Element_Password( 'clave_2' );
        $clave2->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $clave2->setLabel( 'Confirmación Password:' );
        $clave2->addValidator( new Mtt_Validate_PasswordConfirmation() );
        //$this->addElement( $e );


        $direccion = new Zend_Form_Element_Text( 'direccion' );
        $direccion->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $direccion->setLabel( 'Direccion:' );
        //$this->addElement( $e );


        $codPostal = new Zend_Form_Element_Text( 'codpostal' );
        $codPostal->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $codPostal->setLabel( 'Cod. Postal:' );
        //$this->addElement( $e );


        $ciudad = new Zend_Form_Element_Text( 'ciudad' );
        $ciudad->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $ciudad->setLabel( 'Ciudad:' );
        //$this->addElement( $e );


        $paises = new Zend_Form_Element_Select( 'paises_id' );
        $paises->setLabel( '* Escoger Pais' );
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
        $rol->setLabel( '* Rol de Usuario :' );
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
        $institucion->setLabel( 'Institucion:' );
        //$this->addElement( $e );

        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        $this->_translate->translate( 'Save' )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );



        $this->addElements(
                array(
                    $nombre ,
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
