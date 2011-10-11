<?php


class Delta_0011
        extends Mtt_Migration_Delta
    {

    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "cambiando campo fecha de fabricacion";


    public function up()
        {
        $sql = " ALTER TABLE `medtechtrade`.`equipo`     
            CHANGE `fechafabricacion` `fechafabricacion` DATE NULL ;";
        $this->_db->query( $sql );
       
        return true;
        }


    }
