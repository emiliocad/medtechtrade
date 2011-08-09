<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calculadora
 *
 */
class My_Math_Calculadora {

    /**
     * Funcion para sumar
     *
     * @assert (0,0)  == 0
     * @assert (1,1)  == 2
     * @assert (1,3)  == 4
     * @assert (-5,-8)  == -13
     */
    public function suma($a,$b) {
        return $a + $b;
    }

    /**
     * Funcion para Restar
     *
     * @assert (5,2) == 3
     * @assert (5,6) == -1
     *
     */
    public function resta($a,$b){
        return $a-$b;
    }

}

?>
