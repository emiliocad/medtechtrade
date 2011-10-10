<?php


class Delta_0010
        extends Mtt_Migration_Delta
    {

    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "cambiando campos de medidas en tabla equipo";


    public function up()
        {
        $sql = " ALTER TABLE `medtechtrade`.`equipo`     
            CHANGE `size` `size` DECIMAL(10,2) NULL ,     
            CHANGE `ancho` `ancho` DECIMAL(10,2) NULL ,     
            CHANGE `alto` `alto` DECIMAL(10,2) NULL ,     
            CHANGE `sizeCaja` `sizeCaja` DECIMAL(10,2) NULL ;";
        $this->_db->query( $sql );
       
        return true;
        }


    }
