<?php


class Delta_0027
        extends Mtt_Migration_Delta
    {

    protected $_author = self::SLOVACUS;
    protected $_desc = "adicionar mas campos a la tabla config";


    public function up()
        {
        $sql = "
            ALTER TABLE `config`
            ADD COLUMN `usuario_id` INT(11) NOT NULL AFTER `id`,
            ADD COLUMN `pais_id` INT(11) NOT NULL AFTER `usuario_id`,
            ADD COLUMN `idioma_id` INT(11) NOT NULL AFTER `pais_id`;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
