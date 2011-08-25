<?php

class My_Form_Element_Select_Nivel extends Zend_Form_Element_Select {

    protected static $niveles = array(
        '1' => 'Básico',
        '2' => 'intermedio',
        '3' => 'Avanzado'
    );

    public function init() {
        parent::init();
        $this->setLabel("Nivel");
        $this->addMultiOption(-1, '-- Nivel --');
        $this->addMultiOptions(self::$niveles);
        $v = new Zend_Validate_InArray(array_keys(self::$niveles));
        $this->setAttribs(array('class' => 'multi', 'data-basename' => 'nivel'));
        $this->addValidator($v);
        $this->setRequired();
    }

}
?>
