<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_OrderEquipo
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmOrderEquipo' )
        //->setAction( '/categoria/index' )
        ;
        $order = new Zend_Form_Element_Select( 'order' );
        $order->setRequired();
        $order->addMultiOption(
                        -1 , $this->_translate->translate( 'ordenar por' )
                )
                ->addMultiOption( 'fabricante' , 
                        $this->_translate->translate('fabricante') .', A-Z' )
                ->addMultiOption( 'modelo' , 
                        $this->_translate->translate('modelo') . ', A-Z' );
        $order->setAttrib( 'class' , 'order-by' );

        $this->addElement( $order );
        }


    }
