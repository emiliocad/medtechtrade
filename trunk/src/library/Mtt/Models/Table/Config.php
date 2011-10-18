<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_Config
        extends Mtt_Db_Table_Abstract
    {

    protected $_name = 'config';
    protected $_primary = 'id';


    public function __construct()
        {
        parent::__construct();
        }


    }
