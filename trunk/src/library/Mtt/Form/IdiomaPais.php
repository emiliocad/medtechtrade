<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_IdiomaPais
        extends Mtt_Form
    {

    protected $idioma;
    protected $pais;


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmIdiomaPais' )
        ;

        $this->pais = new Zend_Form_Element_Select( 'pais' );
        $this->pais->addMultiOption( $option )->setAttrib( 'icon' , 'icono' );
        $this->addElement( $this->pais );


        $this->idioma = new Zend_Form_Element_Select( 'idioma' );
        $this->addElement( $this->idioma );
        }


    }

