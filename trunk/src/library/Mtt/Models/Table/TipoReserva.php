<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_TipoReserva
        extends Mtt_Db_Table_Abstract
    {

    const RESERVED = 1;
    const FAVORITE = 2;
    
    protected $_name = 'tipo_reserva';
    protected $_primary = 'id';


    }
