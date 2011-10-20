<?php


class Mtt_Form_SubForm_Checkout
        extends Zend_Form_SubForm
    {

    protected $_data;
    protected $_equipo;
    protected $image;
    protected $equipo;
    protected $submit;



    const FIRST_NAME = "first_name";

    protected $rowNumber = 1;


    public function __construct( $data )
        {
        $this->_data = $data;

        $this->image = new Zend_Form_Element_Image( 'image' );
        $this->equipo = new Zend_Form_Element_Text( 'equipo' );
        $this->submit = new Zend_Form_Element_Button( 'submit' );

        parent::__construct();
        }


    public function init()
        {
        parent::init();

        $this->setMethod( Zend_Form::METHOD_POST );

        $this->image->setImage(
                "/media/catalog/product/no_image.png"
        )
        ;
        $this->addElement( $this->image );

        $this->equipo->setValue( "aca ira el Valor" )
        ;

        $this->addElement( $this->equipo );

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

