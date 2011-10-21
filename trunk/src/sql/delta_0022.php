<?php


class Delta_0022
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "ADD campo Integrate en campo";


    public function up()
        {
        $sql = "

             ALTER TABLE `medtechtrade`.`paises`
             ADD COLUMN `integrate` INT NULL AFTER `active`;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
