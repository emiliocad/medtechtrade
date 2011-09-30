<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_CategoriaPregunta
        extends Mtt_Db_Table_Abstract
    {
    
    const Others = 1;

    protected $_name = 'categoriapregunta';
    protected $_primary = 'id';


    public function __construct()
        {
        parent::__construct();
        }


    }
