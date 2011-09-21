<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Pagina
        extends Zend_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmPagina' )
        ;

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
        $nombre->addValidator( $v );
        $this->addElement( $nombre );

        $this->addElement( 'submit' , 'Enviar' );
        }


    }

