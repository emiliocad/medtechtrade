<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_SaveSearch
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmSaveSearch' )
        ;

        /*$e = new Zend_Form_Element_Hidden('busqueda');
        $e->setValue($this->resultados)
          ->removeDecorator('label')
          ->removeDecorator('HtmlTag');         
        $this->addElement($e);*/
        
        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setLabel(
                        $this->_translate->translate( 'Save' )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        $this->addElement( $submit );
        }


    }

