<?php


class Mtt_Form
        extends Zend_Form
    {


    public function __construct( $translator = null )
        {
        //FIXME Revicar porque se puso esto
        $this->setMethod( 'post' );
        $this->addElementPrefixPath( 'Mtt_Form_Decorator' ,
                                     'Mtt/Form/Decorator' , 'decorator' );
        $this->addPrefixPath( 'Mtt_Form_Element' , 'Mtt/Form/Element/' ,
                              'element' );
        parent::__construct();
        }


    }