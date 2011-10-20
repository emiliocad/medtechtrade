<?php


class Mtt_Form_SubForm_Checkout
        extends Zend_Form_SubForm
    {

    protected $_data;
    protected $_equipo;


    const FIRST_NAME = "first_name";

    protected $rowNumber = 1;


    public function __construct( $data )
        {
        $this->_data = $data;
        parent::__construct();
        }


    public function init()
        {
        parent::init();
        $this->setMethod( Zend_Form::METHOD_POST );

        $decorators = array(
            'ViewHelper' ,
            array( 'HtmlTag' , array( 'tag' => 'li' , 'class' => 'form_field' ) )
        );

        /*
         * We want array notation, so we will need to do a belongs to here.
         */
        $this->setElementsBelongTo( "member[{$this->_data["RowNumber"]}]" );




        $this->addElement( "text" , self::FIRST_NAME ,
                           array(
                    "size" => 20 ,
                    "value" => $this->_data["RowNumber"]
                        )
                )
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

