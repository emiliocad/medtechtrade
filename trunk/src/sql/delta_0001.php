<?php


class Delta_0001
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "agregar tabla busqueda";


    public function up()
        {
        $sql =
                "CREATE  TABLE IF NOT EXISTS `medtechtrade`.`busqueda` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `palabras_busqueda` VARCHAR(255) NULL ,

  `modelo` VARCHAR(255) NULL ,

  `fabricante` VARCHAR(255) NULL ,

  `categoria` INT NULL ,

  `anio_inicio` INT NULL ,

  `anio_fin` INT NULL ,

  `precio_inicio` INT NULL ,

  `precio_fin` INT NULL ,

  `usuario_id` INT NOT NULL ,

  PRIMARY KEY (`id`) ,

  CONSTRAINT `fk_busqueda_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION

)ENGINE = INNODB;";
        $this->_db->query( $sql );
        return true;
        }


    }
