<?php


class Delta_0017
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Add Slice table";


    public function up()
        {
        $sql = "
            LOAD DATA LOCAL 
            INFILE 'E:\\Project\\Zend\\medtechtrade.zend.local\\doc\\database-ip\\ipligence-lite.csv' 
            INTO TABLE `medtechtrade`.`ipligence` FIELDS ESCAPED BY '\\' 
            TERMINATED BY ',' ENCLOSED BY '" . "" . "' LINES TERMINATED BY '\r\n' 
                (`ip_from`, `ip_to`, `country_code`, `country_name`, `continent_code`, `continent_name`);
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
