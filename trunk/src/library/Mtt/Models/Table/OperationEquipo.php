<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_OperationEquipo
        extends Mtt_Db_Table_Abstract
    {

    protected $_name = 'operacion_has_equipo';
    protected $_primary = 'equipo_has_formapago_id';


    public function __construct()
        {
        parent::__construct();
        }


    }
