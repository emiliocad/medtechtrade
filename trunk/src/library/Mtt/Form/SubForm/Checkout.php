<?php


class Mtt_Form_SubForm_Checkout
        extends Zend_Form_SubForm
    {

    protected $_data;
    protected $_equipo;
    protected $image;
    protected $equipo;
    protected $equipo_id;
    protected $formaPago;
    protected $eliminar;


    public function __construct( $data )
        {
        if ( !is_null( $data ) )
            {
            $this->_data = $data;
            }
        $this->image = new Zend_Form_Element_Image( 'image' );
        $this->equipo_id = new Zend_Form_Element_Image( 'image' );
        $this->equipo = new Zend_Form_Element_Text( 'equipo' );
        $this->eliminar = new Zend_Form_Element_Button( 'submit' );
        $this->formaPago = new Zend_Form_Element_Select( 'equipo_has_formapago_id' );

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

        $this->setElementsBelongTo( "member[{$this->_data->id}]" );

        $this->image->setImage(
                        "/media/catalog/product/no_image.png"
                )
                ->setDecorators( $decorators )
        ;
        $this->addElement( $this->image );



        $this->equipo->setValue( $this->_data->nombre )
                ->setAttrib( 'disabled' , "disabled" )
                ->setDecorators( $decorators )
        ;

        $this->addElement( $this->equipo );


        /*
         * We want array notation, so we will need to do a belongs to here.
         */

        $this->eliminar->setLabel( 'Eliminar' )
                ->setDecorators( $decorators );

        $this->addElement( $this->eliminar );
        }


    public function setRowNumber( $num )
        {
        $this->rowNumber = ( int ) $num;
        return $this;
        }


    }

