<?php


class Delta_0020
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Add Paises";


    public function up()
        {
        $sql = "
            INSERT INTO paises (nombre,CODE)
 SELECT DISTINCT country_name , country_code 
 FROM ipligence WHERE country_name != '' AND country_code != 'PE';
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
