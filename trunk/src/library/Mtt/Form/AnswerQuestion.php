<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Form_AnswerQuestion
        extends Mtt_Form
    {
    
    protected $id;
    protected $respuesta;
    protected $submit;
    
    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmAnswerQuestion' )
                ->setAction('/admin/pregunta/answerquestion')
                
               
        ;
        
        $this->id = new Zend_Form_Element_Hidden('id'); 
        
        $this->respuesta = new Zend_Form_Element_TextArea( 'respuesta' );
        $this->respuesta->setRequired();
        $this->respuesta->setLabel(
                $this->_translate->translate(
                        'respuesta'
                ) );
        $this->respuesta->setAttrib( 'COLS' , '40' );
        $this->respuesta->setAttrib( 'ROWS' , '4' );
        
        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        $this->_translate->translate( 'respuesta' )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        //$this->addElement( $submit );
        $this->addElements( 
                array(
                    $this->id,
                    $this->respuesta,
                    $this->submit
                )
        );
        }


    }

