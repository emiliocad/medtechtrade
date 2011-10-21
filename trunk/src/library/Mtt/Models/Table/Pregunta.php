<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Models_Table_Pregunta
        extends Mtt_Db_Table_Abstract
    {
    
    const PreguntaNoResulta = 0;
    const PreguntaResulta = 1;
    
    protected $_name = 'pregunta';
    protected $_primary = 'id';


    }
