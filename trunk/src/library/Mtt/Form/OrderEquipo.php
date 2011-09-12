<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO Crear Translate para Zend Form
class Mtt_Form_OrderEquipo
        extends Zend_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmOrderEquipo' )
                ->setAction( '/categoria/index' )
        ;

        $order = new Zend_Form_Element_Select( 'order' );
        $order->addMultiOption( -1 , 'Order By' )
                ->addMultiOption( 1 , 'Manufacturer, A-Z' )
                ->addMultiOption( 2 , 'Model, A-Z' );
        $order->setAttrib( 'class' , 'order-by' );

        $this->addElement( $order );
//
//        $submit = new Zend_Form_Element_Submit( 'submit' );
//        $submit->setAttrib( 'value' , 'Registrar' );
//        $this->addElement( $submit );
        }


    }
