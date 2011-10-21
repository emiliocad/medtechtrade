<?php


class Delta_0031
        extends Mtt_Migration_Delta
    {

    protected $_author = self::SLOVACUS;
    protected $_desc = "add campo columna total a equipo";


    public function up()
        {
        $sql = "
            ALTER TABLE `operacion` ADD COLUMN `total` FLOAT(8,2) NULL AFTER `fechapago`;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
