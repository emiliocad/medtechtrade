<?php


class Delta_0028
        extends Mtt_Migration_Delta
    {

    protected $_author = self::SLOVACUS;
    protected $_desc = "relacion de tabla config";


    public function up()
        {
        $sql = "
            ALTER TABLE `config` ADD CONSTRAINT `FK_config_idiomas` 
            FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`id`) ON 
            DELETE NO ACTION  ON UPDATE NO ACTION ;
            ";

        $this->_db->query( $sql );
        $sql = "
            ALTER TABLE `config` ADD CONSTRAINT `FK_config_usuario` 
            FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) 
            ON DELETE NO ACTION  ON UPDATE NO ACTION ;
            ";

        $this->_db->query( $sql );
        $sql = "
            ALTER TABLE `config` 
            ADD CONSTRAINT `FK_config_paises` FOREIGN KEY (`pais_id`)
            REFERENCES `paises` (`id`) ON DELETE NO ACTION  ON UPDATE NO ACTION ;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
