<?php


class Delta_0030
        extends Mtt_Migration_Delta
    {

    protected $_author = self::SLOVACUS;
    protected $_desc = "add un registro a la tabla de paises";


    public function up()
        {
        $sql = "
            INSERT paises (id,nombre,CODE) VALUES ('500','Others','OT') ;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
