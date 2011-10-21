<?php


class Delta_0029
        extends Mtt_Migration_Delta
    {

    protected $_author = self::SLOVACUS;
    protected $_desc = "cambiar paises a null";


    public function up()
        {
        $sql = "
            ALTER TABLE `config` CHANGE `pais_id` `pais_id` INT(11) NULL ;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
