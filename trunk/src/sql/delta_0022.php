<?php


class Delta_0022
        extends Mtt_Migration_Delta
    {

    protected $_author = "Teresa Chunga E.";
    protected $_desc = "cambio tipo de dato tag y especificaciones de la 
        tabla equipo";


    public function up()
        {
        $sql = "
            ALTER TABLE `medtechtrade`.`equipo`     
            CHANGE `tag` `tag` TEXT NULL ,     
            CHANGE `especificaciones` `especificaciones` TEXT NULL ;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
