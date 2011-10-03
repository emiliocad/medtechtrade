<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 *
 */
class Mtt_Form_LoginCaptcha
        extends Mtt_Formy
    {


    public function __construct( $options = null )
        {
        parent::__construct( $options );
        }


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmLogin' )
        ;

        $text = new Zend_Form_Element_Text( 'text' );
        $text->setLabel( 'nuevo' );
        $text->setRequired();

        $this->addElement( $text );
        $button = new Zend_Form_Element_Button( 'button' );
        $button->setAttrib( 'value' , 'Button' );
        $this->addElement( $button );



//        $captcha = new Zend_Captcha_Image( array(
//                    'name' => 'foo' ,
//                    'wordLen' => 5 ,
//                    'font' => 'VeraMono.ttf' ,
//                    'height' => 50 ,
//                    'width' => 120 ,
//                    'imgDir' => './images/captcha' ,
//                    'imgUrl' => 'http://localhost:8080/test/images/captcha' ,
//                    'timeout' => 300
//                        ) );
//
//        $id = $captcha->generate();
//
//
//        $this->addElement( $id );
//
//
//        $e = $this->getElement( 'username' );
//        $e->addValidator();
        }


    }

