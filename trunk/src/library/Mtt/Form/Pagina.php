<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Pagina
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmPagina' )
        ;



        /* idiomas */
        $idioma = new Zend_Form_Element_Select( 'idiomas_id' );
        $_idioma = new Mtt_Models_Bussines_Idioma();
        $idioma->setLabel( 'Idiomas :' );
        $idioma->addMultiOption( -1 , '--- Idiomas ---' );
        $idioma->addMultiOptions(
                $_idioma->getComboValues()
        );
        $idioma->setRequired();
        $this->addElement( $idioma );
        $idioma->addValidator(
                new Zend_Validate_InArray(
                        array_keys(
                                $_idioma->getComboValues() )
                )
        );

        /* fin de idiomas */

        /* pais */
        $pais = new Zend_Form_Element_Select( 'paises_id' );
        $_pais = new Mtt_Models_Bussines_Paises();
        $pais->setLabel( 'Paises:' );
        $pais->addMultiOption( -1 , '--- Escoger Paises ---' );
        $pais->addMultiOptions( $_pais->getComboValues() );
        $pais->setRequired();
        $this->addElement( $pais );
        $pais->addValidator(
                new Zend_Validate_InArray(
                        array_keys(
                                $_pais->getComboValues()
                        )
        ) );

        /* fin de pais */


        // Elemento: Nombre
        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( 'Nombre' );
        $nombre->setAttrib( 'maxlength' , '50' );
        $nombre->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 50 )
        );
        $v->setMessage(
                "El nombre del producto debe tener debe tener al menos
            %min% characters. '%value%' no cumple ese requisito" ,
                Zend_Validate_StringLength::TOO_SHORT
        );
        $nombre
                ->addValidator( $v )
                ->addValidator(
                        new Zend_Validate_Db_NoRecordExists(
                                array(
                                    'table' => 'pagina' ,
                                    'field' => 'nombre'
                                ) )
                )
        ;

        $this->addElement( $nombre );


        /* body */

        $body = new Mtt_Form_Element_Ckeditor( 'body' );
        $body->setLabel( 'Body :' );
        $body->setRequired();
        $this->addElement( $body );

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

