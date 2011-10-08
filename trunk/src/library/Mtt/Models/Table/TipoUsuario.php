<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_TipoUsuario
        extends Mtt_Db_Table_Abstract
    {

    const MANAGER = 1;
    const REGISTERED = 2;
    const USER = 3;

    protected $_name = 'tipousuario';
    protected $_primary = 'id';


    }
