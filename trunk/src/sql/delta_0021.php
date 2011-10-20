<?php


class Delta_0021
        extends Mtt_Migration_Delta
    {

    protected $_author = "Teresa Chunga E.";
    protected $_desc = "Agregar a tabla equipo campo para especificaciones 
        tecnicas";


    public function up()
        {
        $sql = "
             ALTER TABLE `medtechtrade`.`equipo`     
             ADD COLUMN `especificaciones` VARCHAR(255) 
             CHARSET utf8 COLLATE utf8_unicode_ci NULL AFTER `tag`;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
