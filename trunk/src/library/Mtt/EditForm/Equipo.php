<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_EditForm_Equipo
        extends Mtt_Form_Equipo
    {


    public function init()
        {
       parent::init();
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActualizarEquipo' )
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

