<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_Alerta
        extends Mtt_Db_Table_Abstract
    {
    
    const Busqueda = 1;
    const Categoria = 2;
    const Plataforma = 3;
    const NAlertas = 3;
    
    protected $_name = 'alerta';
    protected $_primary = 'id';


    }
