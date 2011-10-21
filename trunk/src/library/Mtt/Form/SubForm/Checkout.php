<?php


class Mtt_Form_SubForm_Checkout
        extends Mtt_SubForm
    {

    protected $_data;
    protected $_equipo;
    protected $id_equipo;
    protected $_formapago;
    protected $image;
    protected $equipo;
    protected $equipo_id;
    protected $formaPago;
    protected $precio;
    protected $eliminar;


    public function __construct( $data )
        {

        $this->_formapago = new Mtt_Models_Bussines_FormaPago();

        if ( !is_null( $data ) )
            {
            $this->_data = $data;
            }


        $this->image = new Zend_Form_Element_Image( 'image' );
        $this->equipo_id = new Zend_Form_Element_Image( 'image' );
        $this->equipo = new Zend_Form_Element_Text( 'equipo' );
        $this->precio = new Zend_Form_Element_Text( 'precio' );
        $this->eliminar = new Zend_Form_Element_Button( 'submit' );
        $this->formaPago = new Zend_Form_Element_Select( 'equipo_has_formapago_id' );
        $this->id_equipo = new Zend_Form_Element_Hidden( 'equipo_id' );

        parent::__construct();
        }


    public function init()
        {

        $this->setMethod( Zend_Form::METHOD_POST );

        $decorators = array(
            'ViewHelper' ,
            array( 'HtmlTag' , array( 'tag' => 'td' , 'class' => 'form_field' ) )
        );

        $this->setElementsBelongTo( "carro[{$this->_data->getId()}]" );
        $this->id_equipo->setValue( $this->_data->getId() );
        $this->addElement( $this->id_equipo );

        $this->image->setImage(
                        "/media/catalog/product/no_image.png"
                )
                ->setDecorators( $decorators )
        ;
        $this->addElement( $this->image );

        $this->equipo->setValue( $this->_data->getNombre() )
                ->setAttrib( 'readonly' , "readonly" )
                ->setDecorators( $decorators )
        ;
        $this->addElement( $this->equipo );

        $this->precio->setValue( $this->_data->getPrecio() )
                ->setAttrib( 'readonly' , "readonly" )
                ->setDecorators( $decorators );
        $this->addElement( $this->precio );

        $dataFormaPago = $this->_formapago->getComboValues();
        $this->formaPago->addMultiOption( -1 ,
                                          $this->_translate->translate(
                        'escoger forma de pago'
                )
        );
        $this->formaPago->addMultiOptions( $dataFormaPago )
                ->setValue( $this->_data->getEquipo_has_formaPago() );
        $this->addElement( $this->formaPago )
                ;

        $this->formaPago->addValidator(
                new Zend_Validate_InArray(
                        array_keys(
                                $dataFormaPago
                        )
                )
        );


        $this->eliminar->setLabel( 'Eliminar' )
                ->setDecorators( $decorators );

        $this->addElement( $this->eliminar );

        parent::init();
        }


    public function setRowNumber( $num )
        {
        $this->rowNumber = ( int ) $num;
        return $this;
        }


    }

