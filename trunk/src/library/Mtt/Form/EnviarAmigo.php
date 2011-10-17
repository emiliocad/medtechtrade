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
        //->setAction( '/categoria/index' )
        ;
        $order = new Zend_Form_Element_Text( 'email' );
        $order->setRequired();
        
        $order->setAttrib( 'class' , 'order-by' );

        $this->addElement( $order );
        }


    }
