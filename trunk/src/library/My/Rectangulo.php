<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rectangulo
 *
 * @author Consultoria
 */
class My_Rectangulo {
    private $_alto;
    private $_ancho;
    //public $area;

    public function __construct($alto,$ancho) {
        $this->_alto = $alto;
        $this->_ancho = $ancho;
    }

    public function __toString() {
        $texto = "";
        foreach(range(1,$this->_alto) as $i){
            foreach(range(1,$this->_ancho) as $j){
                $texto .= "X";
            }
            $texto .= "<br />";
        }
        
        return "<pre>".$texto. "</pre>";
    }
    
}

?>
