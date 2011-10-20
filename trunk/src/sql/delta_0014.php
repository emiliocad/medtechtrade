<?php

class Delta_0014 extends Mtt_Migration_Delta {

    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "agregar tabla alerta";

    public function up() {
        $sql = "
            CREATE  TABLE IF NOT EXISTS `medtechtrade`.`alerta` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `usuario_id` INT NOT NULL ,
                `descripcion` VARCHAR(120) NULL ,
                `detalle` VARCHAR(255) NULL 
                    COMMENT 'detalle de configuracion de alertas ' ,
                `active` INT NULL DEFAULT 1 ,
                `fecharegistro` DATETIME NULL ,
                `fechamodificacion` DATETIME NULL ,
            PRIMARY KEY (`id`) ,
                CONSTRAINT `fk_alerta_usuario1` 
                FOREIGN KEY (`usuario_id`) 
                REFERENCES `usuario` (`id`) 
                ON DELETE NO ACTION ON UPDATE NO ACTION,
            INDEX `fk_conf_alertas_usuario1` (`usuario_id` ASC) )
            ENGINE = INNODB
            DEFAULT CHARACTER SET = utf8
            COLLATE = utf8_general_ci;
            ";
        
        $this->_db->query($sql);
        
        return true;
    }

}
