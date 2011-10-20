<?php


class Mtt_Form_SubForm_Checkout
        extends Zend_Form_SubForm
    {

    protected $_equipo;
    
    
    const FIRST_NAME = "first_name";

    protected $rowNumber = 1;


    public function init()
        {
        $this->setMethod( Zend_Form::METHOD_POST );

        $decorators = array(
            'ViewHelper' ,
            array( 'HtmlTag' , array( 'tag' => 'li' , 'class' => 'form_field' ) )
        );

        /*
         * We want array notation, so we will need to do a belongs to here.
         */
        $this->setElementsBelongTo( "member[{$this->rowNumber}]" );

        $this->addElement( "text" , self::FIRST_NAME ,
                           array( "size" => 20 , "title" => "" ) )
                ->getElement( self::FIRST_NAME )
                ->setDecorators( $decorators )
                ->addValidator( "Alnum" , false , array( true ) )
                ->addFilter( 'StripTags' )
                ->addValidator( "StringLength" , false ,
                                array( "min" => 2 , "max" => 100 ) );
        }


    public function setRowNumber( $num )
        {
        $this->rowNumber = ( int ) $num;
        return $this;
        }


    }

