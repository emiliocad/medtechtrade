<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registrar
 *
 */
class Mtt_Form_Registrar extends Zend_Form
    {

    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmRegistrar' )
        ;

        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setRequired();
        $e->setLabel( 'Nombre:' );
        $e->addValidator( new Zend_Validate_StringLength( array( 'min' => 5 , 'max' => 25 ) ) );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Text( 'apellido' );
        $e->setRequired();
        $e->setLabel( 'Apellido:' );
        $e->addValidator( new Zend_Validate_StringLength( array( 'min' => 5 , 'max' => 25 ) ) );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Text( 'email' );
        $e->setRequired();
        $e->setLabel( 'Email:' );
        $e->addValidator( new Zend_Validate_EmailAddress() );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Text( 'login' );
        $e->setRequired();
        $e->setLabel( 'Login:' );
        $e->addValidator( new Zend_Validate_Alnum() );
        $e->addValidator( new Zend_Validate_Db_NoRecordExists( array(
                    'table' => 'usuario' ,
                    'field' => 'login' ,
                        ) ) );
        $e->addValidator( new Zend_Validate_StringLength( array( 'min' => 5 , 'max' => 25 ) ) );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Password( 'pwd' );
        $e->setRequired();
        $e->setLabel( 'Password:' );
        $this->addElement( $e );

        $e = new Zend_Form_Element_Password( 'pwd_2' );
        $e->setRequired();
        $e->setLabel( 'Confirmación Password:' );
        $e->addValidator( new My_Validate_PasswordConfirmation() );
        $this->addElement( $e );

        
        $e = new Zend_Form_Element_Text( 'direccion' );
        $e->setRequired();
        $e->setLabel( 'Direccion:' );
        $this->addElement( $e );
        
        
        $e = new Zend_Form_Element_Text( 'codpostal' );
        $e->setRequired();
        $e->setLabel( 'Cod. Postal:' );
        $this->addElement( $e );
        
        
        $e = new Zend_Form_Element_Text( 'ciudad' );
        $e->setRequired();
        $e->setLabel( 'Ciudad:' );
        $this->addElement( $e );
        
        $e = new Zend_Form_Element_Select( 'pais' );
        $e->setRequired();
        $e->setLabel( 'Pais:' );
        $this->addElement( $e );
        
        $e = new Zend_Form_Element_Text( 'institucion' );
        $e->setRequired();
        $e->setLabel( 'Institucion:' );
        $this->addElement( $e );

        $this->addElement( 'submit' , 'Enviar' );
        }

    }

?>
