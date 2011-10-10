<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_EditForm_Moneda
        extends Mtt_Form_Moneda
    {

    public function init()
        {
        parent::init();
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmMoneda' )
        ;

        }
        
    public function __construct( $options = null )
        {

        parent::__construct( $options );
        }
        

    }

