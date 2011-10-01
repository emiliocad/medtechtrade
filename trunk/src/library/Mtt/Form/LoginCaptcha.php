<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 *
 */
class Mtt_Form_LoginCaptcha
        extends Mtt_Form
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmLogin' )
        ;

        $captcha = new Zend_Captcha_Image( array(
                    'name' => 'foo' ,
                    'wordLen' => 5 ,
                    'font' => 'VeraMono.ttf' ,
                    'height' => 50 ,
                    'width' => 120 ,
                    'imgDir' => './images/captcha' ,
                    'imgUrl' => 'http://localhost:8080/test/images/captcha' ,
                    'timeout' => 300
                ) );

        $id = $captcha->generate();

        
        $this->addElement( $id );


        $e = $this->getElement( 'username' );
        $e->addValidator();
        }


    }

