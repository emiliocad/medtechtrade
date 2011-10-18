<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_EnviarAmigo
        extends Mtt_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmEnviarAmigo' )
                //->setAction( '/equipo/enviaramigo' )
        ;
        $email= new Zend_Form_Element_Text( 'email' );
        $email->setLabel( $this->_translate->translate('email'));
        $email->addValidator( new Zend_Validate_EmailAddress() );
        $email->setRequired();

        $this->addElement( $email );
        
        $nombre= new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( 
                $this->_translate->translate('nombre del que envia')
        );
        $nombre->setRequired();

        $this->addElement( $nombre );
        
        $this->addElement( 'submit' ,
                           $this->_translate->translate(
                        'Submit'
                )
        );
        }


    }
