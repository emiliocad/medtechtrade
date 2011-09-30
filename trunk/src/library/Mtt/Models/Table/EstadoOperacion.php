<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_EstadoOperacion
        extends Mtt_Db_Table_Abstract
    {
    
    const FORPAY = 1;
    const SALE = 2;
    const RESERVED = 3;
    
    
    protected $_name = 'estadooperacion';
    protected $_primary = 'id';


    }
