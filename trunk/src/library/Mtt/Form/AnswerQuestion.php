<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Form_AnswerQuestion
        extends Mtt_Form
    {
    
    protected $id;
    protected $answer;
    protected $submit;
    
    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmAnswerQuestion' )
                ->setAction('/admin/pregunta/answerquestion')
                
               
        ;
        
        $this->id = new Zend_Form_Element_Hidden('id'); 
        
        $this->answer = new Zend_Form_Element_TextArea( 'answer' );
        $this->answer->setRequired();
        $this->answer->setLabel(
                $this->_translate->translate(
                        'respuesta'
                ) );
        $this->answer->setAttrib( 'COLS' , '40' );
        $this->answer->setAttrib( 'ROWS' , '4' );
        
        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        $this->_translate->translate( 'answer' )
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
                    $this->answer,
                    $this->submit
                )
        );
        }


    }

