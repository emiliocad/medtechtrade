<?php


class Delta_0026
        extends Mtt_Migration_Delta
    {

    protected $_author = self::SLOVACUS;
    protected $_desc = "crear tabla config para usuario config";


    public function up()
        {
        $sql = "
            CREATE TABLE 
            `config`( `id` INT(11) NOT NULL AUTO_INCREMENT ,
            `active` INT(1) DEFAULT '1' , 
            `fechaactualizacion` DATE ,
            PRIMARY KEY (`id`))  ;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
