<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_PublicacionEquipo
        extends Mtt_Db_Table_Abstract
    {
    
    const Pendiente = 1;
    const Activada = 2;

    protected $_name = 'publicacionequipo';
    protected $_primary = 'id';


    }
