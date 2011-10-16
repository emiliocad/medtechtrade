<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_Equipo
        extends Mtt_Db_Table_Abstract
    {

    protected $_name = 'equipo';
    protected $_primary = 'id';
    protected $nombre;
    protected $precio;
    protected $calidad;


    public function __construct()
        {
        parent::__construct();
        }


    }
