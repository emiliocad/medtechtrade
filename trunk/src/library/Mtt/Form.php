<?php


class Mtt_Form
        extends Zend_Form
    {

    protected $_translate;


    public function __construct( $translator = null )
        {

        $this->setMethod( 'post' );
        $this->addElementPrefixPath( 'Mtt_Form_Decorator' ,
                                     'Mtt/Form/Decorator' , 'decorator' );
//        $this->addPrefixPath( 'Mtt_Form_Element' , 'Mtt/Form/Element/' ,
//                              'element' );
        $this->_translate = Zend_Registry::get( 'Zend_Translate' );
        parent::__construct();
        }


    public function init()
        {
        parent::init();
        $this->addPrefixPath(
                'Mtt_Form_Decorator' , 'Mtt/Form/Decorator/' ,
                                'decorator' );
        }


    }