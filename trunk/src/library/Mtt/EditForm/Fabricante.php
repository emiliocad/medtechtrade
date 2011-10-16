<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_EditForm_Fabricante extends Mtt_Form_Fabricante {

    public function init() {
        parent::init();
        $this
                ->setMethod('post')
                ->setAttrib('id', 'frmActualizarFabricante')
        ;

        $this->submit->setLabel(
                ucwords(
                        $this->_translate->translate('actualizar')
                )
        );
    }

    public function __construct($options = null) {

        parent::__construct($options);
    }

}
