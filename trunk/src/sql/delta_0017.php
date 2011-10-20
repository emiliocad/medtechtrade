<?php


class Delta_0017
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Add imgequipo";


    public function up()
        {
        $sql = "
            ALTER TABLE `medtechtrade`.`imagen`    
            ADD COLUMN `imgequipo` VARCHAR(255) NULL AFTER `avatar`;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
