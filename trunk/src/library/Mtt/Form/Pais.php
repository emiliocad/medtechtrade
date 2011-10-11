<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Pais
        extends Mtt_Formy
    {

    protected $nombre;
    protected $code;
    protected $submit;
    
    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmPais' )
        ;

        //$decorator = new Mtt_Form_Decorator_SimpleInput();

        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setLabel( 
                ucwords( $this->_translate->translate( 'nombre' ) ) . '*:' 
        );
        $this->nombre->setRequired();
        $this->nombre->addValidator(
                new Zend_Validate_StringLength(
                        array(
                            'min' => 2 ,
                            'max' => 50
                        )
                )
        );
        $this->nombre->addValidator( new Zend_Validate_Alnum( true ) );
        $this->nombre->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'paises' ,
                            'field' => 'nombre' ,
                        )
                )
        );
        //$e->setDecorators( array( $decorator ) );
        //$this->addElement( $this->nombre );

        $this->code = new Zend_Form_Element_Text( 'code' );
        $this->code->setLabel( 
                ucwords( $this->_translate->translate( 'code' ) ) . ':' 
        );
        //$e->setDecorators( array( $decorator ) );
        //$this->addElement( $this->code );

        //Submit
        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        ucwords( $this->_translate->translate( 'save' ) )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );

        //$this->addElement( $this->submit );
        
        $this->addElements(
                array(
                    $this->nombre,
                    $this->code,
                    $this->submit
                ));
        
        }


    }

