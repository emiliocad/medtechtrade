<?php


class Mtt_Form_Checkout
        extends Mtt_Form
    {

    const SUBMIT_BUTTON = "submit";
    protected $max = 10;
    protected $submit;
    protected $_data;


    public function __construct( $data = null )
        {
        parent::__construct();
        $this->_data = $data;
        }


    public function init()
        {

        $this->setMethod( Zend_Form::METHOD_POST )
        ;
        
        $this->addMemberForms();
        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel( 'Registrar' )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
                ->setOrder( $this->max + 1 );

        $this->addElement( $this->submit );

        

        /*
         * Left out the rest of the class for simplicity
         */
        }


    public function addMemberForms()
        {
        
        for ( $i = 0; $i < count($this->_data); $i++ )
            {
            $key = "member_" . $i;
            /*
             * Add Subform passing in current row number as well as decorate
             * the subform with ul
             */
            $subform = new Mtt_Form_SubForm_Checkout(
                            array(
                                "RowNumber" => ($i + 1)
                            )
            );
            $this->addSubForm( $subform , $key )
                    ->getSubForm( $key )
                    ->clearDecorators()
                    ->addDecorator( 'FormElements' )
                    ->addDecorator( 'HtmlTag' , array( "tag" => "ul" ) );
            }
        }


    /*
     * Set the Max fields to show, this value is passed to the form constructor
     * new form(array('Max' => 10));
     */


    public function setMax( $max )
        {
        $this->max = $max;

        return $this;
        }


    }
