<?php


class Delta_0008
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "cambiando el valor Default del Usuario";


    public function up()
        {
        $sql =
                "ALTER TABLE `usuario` CHANGE `active` `active` 
                    INT(11) DEFAULT '0' NULL ;";

        $this->_db->query( $sql );
        $sql =
                "ALTER TABLE `usuario` 
                    CHANGE `activacion` `activacion` VARCHAR(200)
                    CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ;";

        $this->_db->query( $sql );
        return true;
        }


    }
