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
    protected $recordar;
    protected $submit;


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmIdiomaPais' )
        ;

        $this->pais = new Zend_Form_Element_Select( 'pais' );
        $this->pais->setLabel(
                        $this->_translate->translate( 'mi pais de residencia' )
                )
                ->addMultiOption( -1 ,
                                  $this->_translate->translate( 'escoger pais' ) )
                ->addMultiOption( 1 , $this->_translate->translate( 'peru' ) );
        $this->addElement( $this->pais );


        $this->idioma = new Zend_Form_Element_Select( 'idioma' );
        $this->idioma->setLabel(
                        $this->_translate->translate( 'mi idioma' )
                )
                ->addMultiOption( -1 ,
                                  $this->_translate->translate( 'escoger idioma' ) )
                ->addMultiOption( 1 , $this->_translate->translate( 'English' ) )
                ->addMultiOption( 2 , $this->_translate->translate( 'English' ) )
                ->addMultiOption( 3 , $this->_translate->translate( 'English' ) )
                ->addMultiOption( 4 , $this->_translate->translate( 'English' ) )
                ->addMultiOption( 5 , $this->_translate->translate( 'English' ) );
        $this->addElement( $this->idioma );


        $this->recordar = new Zend_Form_Element_Checkbox( 'recordar' );
        $this->recordar->setLabel(
                $this->_translate->translate( 'recordar mi configuracion' )
        )
        ;
        $this->addElement( $this->recordar );


        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                $this->_translate->translate( 'siguiente' ) );
        $this->submit->setAttrib( 'type' , 'submit' )

        ;
        $this->addElement( $this->submit );
        }


    }

