<?php


class Delta_0012
        extends Mtt_Migration_Delta
    {

    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "agregando campos a tabla usuario";


    public function up()
        {
        $sql = " ALTER TABLE `medtechtrade`.`usuario`     
            ADD COLUMN `tratamiento` VARCHAR(10) NULL AFTER `direccion2`,     
            ADD COLUMN `telefono` VARCHAR(45) NULL AFTER `tratamiento`,     
            ADD COLUMN `fax` VARCHAR(45) NULL AFTER `telefono`,     
            ADD COLUMN `fechamodificacion` DATETIME NULL AFTER `fax`;";
        $this->_db->query( $sql );
       
        $sql = " ALTER TABLE `medtechtrade`.`usuario`     
            CHANGE `tratamiento` `tratamiento` INT NULL  
            COMMENT '0 Sr, 1 Sra/Srta'";
        $this->_db->query( $sql );
        
        return true;
        }


    }
