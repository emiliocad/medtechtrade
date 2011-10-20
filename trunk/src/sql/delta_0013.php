<?php


class Delta_0013
        extends Mtt_Migration_Delta
    {

    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "agregando registro en publicacion para vendidos";


    public function up()
        {
        $sql = " INSERT INTO `publicacionequipo`(`id`,`nombre`,`active`) 
            VALUES ( '4','Vendido','1');";
        $this->_db->query( $sql );
       
        return true;
        }


    }
