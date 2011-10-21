<?php


class Mtt_Form_Checkout
        extends Mtt_Form
    {

    protected $submit;
    protected $actualizar;
    protected $_data;


    public function __construct( $data = null )
        {
        if ( !is_null( $data ) )
            {
            $this->_data = $data;
            }

        parent::__construct();
        }


    public function init()
        {

        $this->setMethod( Zend_Form::METHOD_POST )
        //->setAction( '/user/checkout/cart/' )
        ;
        $this->addMemberForms();
        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel( $this->_translate->translate( 'actualizar' ) )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );

        $this->addElement( $this->submit );

        $this->actualizar = new Zend_Form_Element_Button( 'actualizar' );
        $this->actualizar->setLabel( 'actualizar' )
                ->setAttrib(
                        'class' , 'button'
        );

        $this->addElement( $this->actualizar );
        }


    public function addMemberForms()
        {

        for ( $i = 0; $i < count( $this->_data ); $i++ )
            {
            $key = "member_" . $i;
            /*
             * Add Subform passing in current row number as well as decorate
             * the subform with ul
             */
            $subform = new Mtt_Form_SubForm_Checkout(
                            $this->_data[$i]
            );
            $this->addSubForm( $subform , $key )
                    ->getSubForm( $key )
                    ->clearDecorators()
                    ->addDecorator( 'FormElements' )
                    ->addDecorator( 'HtmlTag' , array( "tag" => "ul" ) );
            }
        }


    }
