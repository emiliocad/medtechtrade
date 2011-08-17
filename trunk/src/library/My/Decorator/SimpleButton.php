<?php

class My_Decorator_SimpleButton extends Zend_Form_Decorator_Abstract
    {

//    protected $_format = '<p><label for="%s">%s</label>
//    <input id="%s" name="%s" type="text" value="%s"/></p>';
    protected $_format = '<div class="actionButton submit">
					<input id="%s" name="%s" type="%s" value="%s">
				</div>';

    public function render( $content )
        {
        $element = $this->getElement();
        $name = htmlentities( $element->getFullyQualifiedName() );
        $label = htmlentities( $element->getLabel() );
        $id = htmlentities( $element->getId() );
        $value = htmlentities( $element->getValue() );
        $type = htmlentities( $element->getType() );


        $markup = sprintf( $this->_format , $id , $name , $type , $value );
        return $markup;
        }

    }

?>