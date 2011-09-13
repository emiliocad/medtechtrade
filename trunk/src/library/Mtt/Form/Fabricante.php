<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Fabricante
        extends Mtt_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmFabricante' )
        ;

        // Elemento: Nombre
        $e = new Zend_Form_Element_Text( 'nombre' );
        $e->setLabel( 'Nombre :' );
        $e->setAttrib( 'maxlength' , '50' );
        $e->setRequired( true );
        $e->addValidator( new Zend_Validate_Db_NoRecordExists( array(
                    'table' => 'fabricantes' ,
                    'field' => 'nombre' ,
                        ) ) );
        $e->addValidator( new Zend_Validate_StringLength( array( 'min' => 5 , 'max' => 25 ) ) );

        $this->addElement( $e );

        $this->addElement( 'submit' , 'Enviar' );
        }


    }
