<?php

class My_Form_Element_Text_Empresa extends Zend_Form_Element_Text {

    public function init() {
        parent::init();
        $v = new Zend_Validate_StringLength(array('min' => 2, 'max' => 10));
        $this->addValidator($v);
        $this->setAttribs(array('class' => 'multi', 'data-basename' => 'empresa'));
        $this->setRequired();
    }

}