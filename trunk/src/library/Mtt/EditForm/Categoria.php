<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO Crear Translate para Zend Form
class Mtt_EditForm_Categoria
        extends Mtt_Form_Categoria
    {

       public function init()
        {
        parent::init();
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActulizarCategoria' )
        ;
         $this->submit->setLabel(
                ucwords(
                        $this->_translate->translate( 'actualizar' )
                )
        );

        }
        
    public function __construct( $options = null )
        {

        parent::__construct( $options );
        }


    }
