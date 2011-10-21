<?php


class Delta_0005
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "agregando 2 campos de direccion";


    public function up()
        {
        $sql = "ALTER TABLE usuario
ADD direccion1 VARCHAR(200)";
        $this->_db->query( $sql );
        $sql = "ALTER TABLE usuario
ADD direccion2 VARCHAR(200)";
        $this->_db->query( $sql );

        return true;
        }


    }
