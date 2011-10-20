<?php


class Mtt_SubForm
        extends Zend_Form_SubForm
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
        }


    }

