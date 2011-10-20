<?php


class Delta_0019
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "active en Idioma";


    public function up()
        {
        $sql = "
            ALTER TABLE `medtechtrade`.`idiomas` 
            CHANGE `active` `active` INT(11) DEFAULT '1' NULL ;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
